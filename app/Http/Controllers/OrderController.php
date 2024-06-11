<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function checkout(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        $response = Http::withHeaders([
            'key' => '7b56cec1d370390a4028d16c89d266d9'
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

        // Ensure $product is retrieved successfully
        if (!$product) {
            // Handle error if product is not found
            abort(404, 'Product not found');
        }

        // Perform request to RajaOngkir API to get shipping services and costs
        $response = Http::withHeaders([
            'key' => '7b56cec1d370390a4028d16c89d266d9'
        ])->post('https://api.rajaongkir.com/starter/cost', [
                    'origin' => $request['address_from'],
                    'destination' => $request['destination'],
                    'weight' => $request['weight'],
                    'courier' => $request['courier'],
                ]);

        $services = [];
        $shippingCosts = 0;

        $responseData = $response->json();

        if (isset($responseData['rajaongkir']['results'])) {
            foreach ($responseData['rajaongkir']['results'] as $result) {
                foreach ($result['costs'] as $cost) {
                    $services[] = [
                        'service' => $cost['service'],
                        'description' => $cost['description'],
                        'cost' => $cost['cost'][0]['value'], // Assuming only one cost is returned
                        'etd' => $cost['cost'][0]['etd'], // Estimated time of delivery
                    ];
                    // $shippingCosts += $cost['cost'][0]['value'];
                }
            }
        }

        $value = $result['costs'][0]['cost'][0]['value'];
        $price = $product->price;
        $quantity = $request['quantity'];
        $total = $value + ($price * $quantity);

        $courier = $request['courier'];

        return view('orders.payment', compact('product', 'services', 'shippingCosts', 'total', 'courier'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'address_to' => 'required|string',
            'courier' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'total' => 'required|integer',
            'payment' => 'required|string',
        ]);

        $order = Order::create([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
            'address_to' => $request->address_to,
            'courier' => $request->courier,
            'quantity' => $request->quantity,
            'total' => $request->total,
            'payment' => $request->payment,
            'status' => false,
        ]);

        return redirect()->route('orders.show', $order)->with('success', 'Order placed successfully!');
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
