<?php

namespace App\Http\Controllers;

use App\Models\AllCarts;
use Illuminate\Http\Request;

class AllCartsController extends Controller
{

    public function index()
{
    try {
        $allCarts = AllCarts::orderBy('id', 'desc')->get();
        return response()->json($allCarts, 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Internal Server Error'], 500);
    }
}


    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'item' => 'required|max:255',
                'category' => 'required|max:255',
                'price' => 'required|numeric',
                'description' => 'required|max:255',
                'accountno' => 'required|numeric',
                'paymethod' => 'required|max:255',
                'amount' => 'required|numeric',
                'total' => 'required|numeric',
            ]);

            $allCarts = AllCarts::create($validated);
            return response()->json(['message' => 'Cart item created successfully', 'data' => $allCarts], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function show($id)
    {
        try {
            $cart = AllCarts::findOrFail($id);
            return response()->json($cart, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }


public function update(Request $request, $id)
{
    try {
        $validated = $request->validate([
            'item' => 'sometimes|required|max:255',
            'category' => 'sometimes|required|max:255',
            'price' => 'sometimes|required|numeric',
            'description' => 'sometimes|required|max:255',
            'accountno' => 'sometimes|required|numeric',
            'paymethod' => 'sometimes|required|max:255',
            'amount' => 'sometimes|required|numeric',
            'total' => 'sometimes|required|numeric',
        ]);

        $cart = AllCarts::findOrFail($id);
        $cart->update($validated);

        return response()->json(['message' => 'Cart item updated successfully', 'data' => $cart], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Internal Server Error'], 500);
    }
}


    public function destroy($id)
    {
        try {
            $cart = AllCarts::findOrFail($id);
            $cart->delete();
            return response()->json(['message' => 'Cart item deleted successfully', 'data' => $cart], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}
