<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ShopController extends Controller
{
    public function index()
    {
        try {
            $shops = Shop::all();
            return response()->json($shops, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

 public function store(Request $request)
{
    try {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'category' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('shops', 'public');
            $validated['image'] = $imagePath;
        }

        $shop = Shop::create($validated);
        return response()->json(['message' => 'Shop created successfully', 'data' => $shop], 201);
    } catch (\Exception $e) {
        // Log the exception for further investigation
        \Log::error('Store Shop Error: ' . $e->getMessage());

        // Return a generic error response
        return response()->json(['error' => 'Failed to store shop.'], 500);
    }
}

// Similar adjustments for other methods...



    public function show(Shop $shop)
    {
        try {
            return response()->json($shop, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function update(Request $request, Shop $shop)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|max:255',
                'category' => 'required',
                'price' => 'required|numeric',
                'description' => 'required',
            ]);

            if ($request->hasFile('image')) {
                Storage::disk('public')->delete($shop->image);
                $imagePath = $request->file('image')->store('shops', 'public');
                $validated['image'] = $imagePath;
            }

            $shop->update($validated);
            return response()->json(['message' => 'Shop updated successfully', 'data' => $shop], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

public function destroy(Shop $shop)
{
    try {
        if ($shop->image) {
            Storage::disk('public')->delete($shop->image);
        }

        $shop->delete();
        return response()->json(['message' => 'Shop deleted successfully', 'data' => $shop], 200);
    } catch (\Exception $e) {
        \Log::error('Error: ' . $e->getMessage());
        return response()->json(['error' => 'Internal Server Error'], 500);
    }
}

}
