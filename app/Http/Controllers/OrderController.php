<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class OrderController extends Controller
{
    public function checkout(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        $response = Http::withHeaders([
            'key' => env('API_RAJA_ONGKIR')
        ])->get('https://api.rajaongkir.com/starter/city');
        $cities = [];
        if ($response->successful()) {
            $cityData = $response->json();
            if (isset($cityData['rajaongkir']['results'])) {
                $cities = $cityData['rajaongkir']['results'];
            }
        }

        return view('orders.checkout', compact('product', 'cities'));
    }

    public function payment(Request $request)
    {
        $product = Product::find($request['product_id']);

        if (!$product) {
            abort(404, 'Product not found');
        }

        $response = Http::withHeaders([
            'key' => env('API_RAJA_ONGKIR')
        ])->post('https://api.rajaongkir.com/starter/cost', [
                    'origin' => $request['address_from'],
                    'destination' => $request['destination'],
                    'weight' => $request['weight'],
                    'courier' => $request['courier'],
                ]);

        $services = [];
        $responseData = $response->json();

        if (isset($responseData['rajaongkir']['results'])) {
            foreach ($responseData['rajaongkir']['results'] as $result) {
                foreach ($result['costs'] as $cost) {
                    $services[] = [
                        'service' => $cost['service'],
                        'description' => $cost['description'],
                        'cost' => $cost['cost'][0]['value'],
                        'etd' => $cost['cost'][0]['etd'],
                    ];
                }
            }
        }

        $value = $result['costs'][0]['cost'][0]['value'];
        $price = $product->price;
        $quantity = $request['quantity'];
        $total = $value + ($price * $quantity);

        $courier = $request['courier'];

        return view('orders.payment', compact('product', 'services', 'total', 'courier'));
    }

    public function store(Request $request)
    {
        // validasi data dari halaman sebelumnya
        $request->validate([
            'price' => 'required',
            'product_name' => 'required',
            'product_id' => 'required|exists:products,id',
            'address_to' => 'required|string',
            'courier' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'total' => 'required|integer',
            'payment' => 'required|string',
        ]);

        // bakal mencari produk
        $product = Product::findOrFail($request->product_id);

        // cek apakah stock nya cukup
        if ($product->stock < $request->quantity) {
            return back()->withErrors(['quantity' => 'Insufficient stock available.']);
        }

        $order = null;

        // konfigurasi untuk ipaymu
        $va = '0000002245111828';
        $apiKey = 'SANDBOXEAF3FDF6-77DC-45C6-8486-76CF245B070D';
        $url = 'https://sandbox.ipaymu.com/api/v2/payment';
        // untuk kirim data
        $method = 'POST';

        // untuk detail barang
        $products = (array) $request->product_name;
        $quantities = (array) 1;
        $prices = (array) $request->total;

        // ini akan dikirim ke ipaymu
        $body = [
            'product' => $products,
            'qty' => $quantities,
            'price' => $prices,
            'returnUrl' => 'http://127.0.0.1:8001/order/status',
            'notifyUrl' => $request->input('notifyUrl', 'http://example.com/notify'),
            'cancelUrl' => $request->input('cancelUrl', 'http://example.com/cancel'),
            'referenceId' => $request->input('referenceId', 'default_reference')
        ];

        $jsonBody = json_encode($body, JSON_UNESCAPED_SLASHES);
        $requestBody = strtolower(hash('sha256', $jsonBody));
        $stringToSign = strtoupper($method) . ':' . $va . ':' . $requestBody . ':' . $apiKey;
        $signature = hash_hmac('sha256', $stringToSign, $apiKey);
        $timestamp = now()->format('YmdHis');

        $client = new Client();
        $headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'va' => $va,
            'signature' => $signature,
            'timestamp' => $timestamp
        ];

        try {
            $response = $client->request('POST', $url, [
                'headers' => $headers,
                'body' => $jsonBody
            ]);
            $ret = json_decode($response->getBody()->getContents());

            if ($ret && $ret->Status == 200) {
                $sessionId = $ret->Data->SessionID;
                // dd($sessionId);
                $paymentUrl = $ret->Data->Url;

                // update database local
                DB::transaction(function () use ($request, $product, &$order, $sessionId) {
                    // dd($sessionId);
                    $order = Order::create([
                        'user_id' => auth()->id(),
                        'product_id' => $request->product_id,
                        'payment_id' => $sessionId,
                        'address_to' => $request->address_to,
                        'courier' => $request->courier,
                        'quantity' => $request->quantity,
                        'total' => $request->total,
                        'payment' => $request->payment,
                        'status' => false,
                    ]);

                    $product->decrement('stock', $request->quantity);
                });

                return redirect($paymentUrl);
            } else {
                return back()->withErrors(['payment' => 'Payment initiation failed. Please try again.'])->with('response', $ret);
            }
        } catch (RequestException $e) {
            return back()->withErrors(['payment' => 'HTTP Request Error: ' . $e->getMessage()]);
        }


        // // Check if the order was created
        // if ($order) {
        //     return redirect()->route('orders.show', $order->id)->with('success', 'Order placed successfully!');
        // }

        // return back()->withErrors(['order' => 'Order could not be created. Please try again.']);
    }

    public function status(Request $request)
    {
        $sid = $request['sid'];
        $status = ($_REQUEST['status'] == 'berhasil') ? '1' : '0';
        $payment_method = $request['payment_method'];

        $order = Order::where('payment_id', $sid)->firstOrFail();

        $order->payment_id = $sid;
        $order->status = $status;
        $order->payment_method = $payment_method;

        $order->save();

        return redirect('/');
    }

    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    public function index()
    {
        $orders = Order::where('user_id', auth()->id())->get();
        return view('orders.index', compact('orders'));
    }

}
