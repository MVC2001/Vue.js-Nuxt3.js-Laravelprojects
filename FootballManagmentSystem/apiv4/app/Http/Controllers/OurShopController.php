<?php

namespace App\Http\Controllers;
use App\Models\Shop;
use Illuminate\Http\Request;

class OurShopController extends Controller
{
    public function index()
{
    return Shop::orderBy('id', 'desc')->get();
}


    public function show($id)
    {
        return Shop::findOrFail($id);
    }

   public function store(Request $request)
{
    try {
        $data = $request->validate([
            'item' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }

        $ground = Shop::create($data);

        return response()->json(['message' => 'New Item added successfully', 'ground' => $ground], 200);

    } catch (\Exception $e) {
        // Handle exceptions here
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

    public function update(Request $request, $id)
    {
        $ground = Shop::findOrFail($id);

        $data = $request->validate([
            'item' => 'required',
            'category' => 'required',
            'price' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;

            if ($ground->image) {
                unlink(public_path('images/' . $ground->image));
            }
        }

        $ground->update($data);

        return $ground;
    }

    public function destroy($id)
    {
        $ground = Shop::findOrFail($id);

        if ($ground->image) {
            unlink(public_path('images/' . $ground->image));
        }

        $ground->delete();

        return response()->json(['message' => 'Record deleted successfully'], 200);
    }
}
