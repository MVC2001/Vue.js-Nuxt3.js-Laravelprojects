<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ground;

class GroundAccountContoller extends Controller
{
     public function index()
    {
        return Ground::all();
    }

    public function show($id)
    {
        return Ground::findOrFail($id);
    }

   public function store(Request $request)
{
    try {
        $data = $request->validate([
            'name' => 'required',
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

        $ground = Ground::create($data);

        return response()->json(['message' => 'Ground added successfully', 'ground' => $ground], 200);

    } catch (\Exception $e) {
        // Handle exceptions here
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

    public function update(Request $request, $id)
    {
        $ground = Ground::findOrFail($id);

        $data = $request->validate([
            'name' => 'required',
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
        $ground = Ground::findOrFail($id);

        if ($ground->image) {
            unlink(public_path('images/' . $ground->image));
        }

        $ground->delete();

        return response()->json(['message' => 'Record deleted successfully'], 200);
    }
}
