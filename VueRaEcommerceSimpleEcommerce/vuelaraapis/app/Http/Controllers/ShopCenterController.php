<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopCenterController extends Controller
{
    public function index()
{
    try {
        $shopitems = Product::orderBy('created_at', 'desc')->get(); // Order by created_at in descending order
        return response()->json($shopitems, 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Internal Server Error'], 500);
    }
}


    public function create()
    {

    }

     public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'name' => 'required',
                'category' => 'required',
                'price' => 'required',
                'description' => 'required',
            ]);

            $input = $request->all();

            if ($image = $request->file('image')) {
                $destinationPath = 'images/product/';
                $productImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $productImage);
                $input['image'] = "$productImage";
            }

            Product::create($input);

            return response()->json(['message' => 'Product created successfully', 'data' => $input], 201);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function show(Product $shopitem) // Change variable name from $product to $shopitem
    {
        try {
            return response()->json($shopitem, 200);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }



   public function update(Request $request, Product $shopitem)
{
    try {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required',
            'category' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);

        $input = $request->all();

        if ($request->hasFile('image')) {
            $destinationPath = 'images/product/';
            $productImage = date('YmdHis') . "." . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move($destinationPath, $productImage);
            $input['image'] = $productImage;
        } else {
            unset($input['image']);
        }

        $shopitem->update($input);

        return response()->json(['message' => 'Product updated successfully', 'data' => $input], 200);

    } catch (\Exception $e) {
        return response()->json(['error' => 'Internal Server Error'], 500);
    }
}

    public function destroy(Product $shopitem) // Change variable name from $product to $shopitem
    {
        try {
            $shopitem->delete(); // Change variable name from $product to $shopitem
            return response()->json(['message' => 'Product deleted successfully', 'data' => $shopitem], 200);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}
