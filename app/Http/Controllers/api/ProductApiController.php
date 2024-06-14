<?php

namespace App\Http\Controllers\api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductApiController extends Controller
{
    public function index(Request $request)
    {
        try {
            $search = $request->query('search');

            // Query products and apply search filter if a search term is provided
            $products = Product::query();
            if ($search) {
                $products->where('product_name', 'like', '%' . $search . '%');
            }

            $products = $products->paginate(4);

            return response()->json([
                'success' => true,
                'products' => $products
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve data from database.'
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validateData = $request->validate([
                'product_name' => 'required|max:255',
                'description' => 'required',
                'price' => 'required',
                'weight' => 'required',
                'address_from' => 'required',
                'stock' => 'required',
                'image' => 'nullable'
            ]);

            if ($request->hasFile('image')) {
                $validatedData['image'] = $request->file('image')->store('/post-images');
            }

            $product = Product::create($validateData);

            // Return response
            return response()->json([
                'success' => 'true',
                'product' => $product,
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve data from database.'
            ], 500);
        }
    }
}
