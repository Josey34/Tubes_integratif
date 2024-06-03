<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::all();
        $cart = $request->session()->get('cart', []);

        return view('orders.index', compact('orders', 'cart'));
    }

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
            $order = Order::create([
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

        $orders = Order::with('product')->get();

        return redirect()->route('orders.index')->with('success', 'Product added to cart.');
    }

    public function checkout(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $user_id = Auth::id();

        // Fetch the existing order for the user and product, if it exists
        $order = Order::where('user_id', $user_id)
            ->where('product_id', $productId)
            ->first();

        return view('orders.checkout', compact('product', 'order'));
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
}
