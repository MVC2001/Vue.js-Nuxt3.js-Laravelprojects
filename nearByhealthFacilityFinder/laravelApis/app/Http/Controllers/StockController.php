<?php

namespace App\Http\Controllers;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        return Stock::orderBy('id', 'desc')->get();
    }

    public function show($id)
    {
        return Stock::findOrFail($id);
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'productName' => 'required',
                'category' => 'required',
                'price' => 'required|numeric',
                'description' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'quantity' => 'required|numeric',
            ]);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $data['image'] = $imageName;
            }

            $stock = Stock::create($data);

            return response()->json(['message' => 'New Item added successfully', 'stock' => $stock], 200);

        } catch (\Exception $e) {
            // Handle exceptions here
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $stock = Stock::findOrFail($id);

        $data = $request->validate([
            'productName' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'quantity' => 'required|numeric',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;

            if ($stock->image) {
                unlink(public_path('images/' . $stock->image));
            }
        }

        $stock->update($data);

        return $stock;
    }

    public function destroy($id)
    {
        $stock = Stock::findOrFail($id);

        if ($stock->image) {
            unlink(public_path('images/' . $stock->image));
        }

        $stock->delete();

        return response()->json(['message' => 'Record deleted successfully'], 200);
    }
}
