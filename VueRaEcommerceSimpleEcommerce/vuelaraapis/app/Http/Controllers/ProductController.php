<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        try {
            $products = Product::all();
            return response()->json($products, 200);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|max:255',
                'description' => 'required',
                'price' => 'required|numeric',
            ]);

            $product = Product::create($validated);
            return response()->json(['message' => 'Product created successfully', 'data' => $product], 201);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function show(Product $product)
    {
        try {
            return response()->json($product, 200);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function update(Request $request, Product $product)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|max:255',
                'description' => 'required',
                'price' => 'required|numeric',
            ]);

            $product->update($validated);
            return response()->json(['message' => 'Product updated successfully', 'data' => $product], 200);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function destroy(Product $product)
    {
        try {
            $product->delete();
            return response()->json(['message' => 'Product deleted successfully', 'data' => $product], 200);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}
