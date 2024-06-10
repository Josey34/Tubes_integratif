<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::all();
        $cart = $request->session()->get('cart', []);

        return view('orders.index', compact('orders', 'cart'));
    }

    //

    public function addToCart($product_id)
    {
        $user_id = Auth::id();
        $product = Product::find($product_id);

        if (!$product) {
            logger()->error('Product not found', ['product_id' => $product_id]);
            return redirect()->back()->with('error', 'Product not found.');
        }

        $existingOrder = Order::where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->first();

        if ($existingOrder) {
            $existingOrder->update([
                'quantity' => $existingOrder->quantity + 1,
                'total' => $existingOrder->total + $product->price
            ]);
        } else {
            Order::create([
                'user_id' => $user_id,
                'product_id' => $product_id,
                'address_to' => 'address', // Update with actual address from user input
                'courier' => 'courier', // Update with actual courier from user input
                'quantity' => 1,
                'total' => $product->price,
                'payment' => 'pending',
                'status' => false
            ]);
        }

        return redirect()->route('orders.checkout', $product_id)->with('success', 'Product added to orders.');
    }

    public function checkout(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $user_id = Auth::id();

        $order = Order::where('user_id', $user_id)
            ->where('product_id', $productId)
            ->first();

        $response = Http::withHeaders([
            'key' => '7b56cec1d370390a4028d16c89d266d9'
        ])->get('https://api.rajaongkir.com/starter/city');

        $cities = $response->json()['rajaongkir']['results'] ?? [];

        return view('orders.checkout', compact('product', 'order', 'cities'));
    }


    public function create()
    {
        // dd('APAAAA');
        return view('orders.create');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'address_to' => 'required',
            'courier' => 'required',
            'quantity' => 'required',
            'total' => 'required',
            'payment' => 'required',
            'status' => 'required'
        ]);

        $validateData['user_id'] = auth()->id();

        Order::create($validateData);

        return redirect('/orders')->with('success', 'New order has been added');
    }

    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        return view('orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $validatedData = $request->validate([
            'address_to' => 'required',
            'courier' => 'required',
            'quantity' => 'required|integer|min:1',
            'total' => 'required|numeric|min:0',
            'payment' => 'required',
            'status' => 'required'
        ]);

        $order->update($validatedData);

        return redirect()->route('orders.index')->with('success', 'Order has been updated');
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect('/orders')->with('success', 'Order has been deleted');
    }

    public function hitungOngkir(Request $request)
    {
        $user_id = Auth::id();
        $product = Product::findOrFail($request->product_id);

        // Fetch the cities
        $response = Http::withHeaders([
            'key' => '7b56cec1d370390a4028d16c89d266d9'
        ])->get('https://api.rajaongkir.com/starter/city');
        $responseArray = $response->json();
        $cities = $responseArray['rajaongkir']['results'] ?? [];

        // Calculate the shipping cost
        $costResponse = Http::withHeaders([
            'key' => '7b56cec1d370390a4028d16c89d266d9'
        ])->post('https://api.rajaongkir.com/starter/cost', [
                    'origin' => $request->address_from,
                    'destination' => $request->destination,
                    'weight' => $request->weight,
                    'courier' => $request->courier,
                ]);
        $costArray = $costResponse->json();
        if (isset($costArray['rajaongkir'])) {
            $ongkir = $costArray['rajaongkir'];
        } else {
            $ongkir = [];
        }

        // dd($costArray);

        // Get product details
        $product = Product::findOrFail($request->product_id);
        $quantity = $request->quantity;
        $totalPrice = $product->price * $quantity;

        // Calculate total payment
        $totalPayment = $totalPrice;
        if (isset($ongkir['results']) && count($ongkir['results']) > 0) {
            $selectedService = $request->input('service'); // Get the selected service from the request
            foreach ($ongkir['results'] as $result) {
                if ($result['code'] == $request->courier) {
                    foreach ($result['costs'] as $cost) {
                        if ($cost['service'] == $selectedService) {
                            $totalPayment += $cost['cost'][0]['value'];
                        }
                    }
                }
            }
        }

        // Create the order
        $order = Order::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'address_to' => $request->destination,
            'courier' => $request->courier,
            'quantity' => $quantity,
            'total' => $totalPayment,
            'payment' => 'pending',
            'status' => false
        ]);

        return view('orders.payment', ['order' => $order, 'ongkir' => $ongkir]);
    }
    public function payment(Order $order)
    {
        return view('orders.payment', compact('order'));
    }



}
