<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.products.index', [
            'products' => Product::all()
        ]);
    }

    public function create()
    {
        $response = Http::withHeaders([
            'key' => '7b56cec1d370390a4028d16c89d266d9'
        ])->get('https://api.rajaongkir.com/starter/city');

        $responseArray = $response->json();
        $cities = $responseArray['rajaongkir']['results'] ?? [];

        return view('dashboard.products.create', compact('cities'));
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'product_name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required',
            'weight' => 'required',
            'address_from' => 'required',
            'stock' => 'required',
            'image' => 'required'
        ]);

        if ($request->file('image')) {
            $validateData['image'] = $request->file('image')->store('post-images');
        }

        Product::create($validateData);

        return redirect()->route('dashboard.index')->with('success', 'New product has been added');
    }

    public function show($product)
    {
        $product = Product::findOrFail($product);
        return view('dashboard.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $product = Product::findOrFail($product->id);

        $response = Http::withHeaders([
            'key' => '7b56cec1d370390a4028d16c89d266d9'
        ])->get('https://api.rajaongkir.com/starter/city');

        $responseArray = $response->json();
        $cities = $responseArray['rajaongkir']['results'] ?? [];

        return view('dashboard.products.edit', compact('product', 'cities'));
    }

    public function update(Request $request, Product $product)
    {
        $validateData = $request->validate([
            'product_name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required',
            'weight' => 'required',
            'address_from' => 'required',
            'stock' => 'required',
            'image' => 'required'
        ]);

        if ($request->file('image')) {
            if ($product->image) {
                Storage::delete($product->image);
            }
            $validateData['image'] = $request->file('image')->store('post-images');
        } else {
            $validateData['image'] = $product->image;
        }

        $product->update($validateData);

        return redirect()->route('dashboard.show', $product->id)->with('success', 'Product has been updated');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::delete($product->image);
        }

        Product::destroy($product->id);

        return redirect()->route('dashboard.index')->with('success', 'Product has been deleted');
    }
}
