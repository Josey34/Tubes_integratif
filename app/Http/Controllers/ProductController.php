<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('home', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
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


        if($request->file('image')) {
            $validateData['image'] = $request->file('image')->store('post-images');
        }

        // $file = $request->file('image');
        // $path = time() . '_' . $request->name . '.' . $file->getClientOriginalExtension();

        // Storage::disk('local')->put('public/' . $path, file_get_contents($file));


        Product::create($validateData);

        return redirect('product')->with('success', 'New post has been added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $productId = $product->id;
        $product = Product::findOrFail($productId);
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if($product->image) {
            Storage::delete($product->image);
        }

        Product::destroy($product->id);

        return redirect('/')->with('success', 'Post has been deleted');
    }

}
