<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Query products and apply search filter if a search term is provided
        $products = Product::query();
        if ($search) {
            $products->where('product_name', 'like', '%' . $search . '%');
        }

        // Paginate the filtered results
        $products = $products->paginate(4); // Change the number as per your requirement

        return view('products.index', compact('products', 'search'));
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}
