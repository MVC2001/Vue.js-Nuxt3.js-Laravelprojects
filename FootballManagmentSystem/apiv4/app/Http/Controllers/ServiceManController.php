<?php

namespace App\Http\Controllers;
use App\Models\Smans;
use Illuminate\Http\Request;

class ServiceManController extends Controller
{
    public function index()
    {
        return Smans::orderBy('id', 'desc')->get();
    }

    public function show($id)
    {
        return Smans::findOrFail($id);
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'fullname' => 'required',
                'address' => 'required',
                'contact' => 'required',
                'gender' => 'required',
                'role' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $data['image'] = $imageName;
            }

            $serviceMan = Smans::create($data);

            return response()->json(['message' => 'New ServiceMan added successfully', 'serviceMan' => $serviceMan], 200);

        } catch (\Exception $e) {
            // Handle exceptions here
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $serviceMan = Smans::findOrFail($id);

        $data = $request->validate([
            'fullname' => 'required',
            'address' => 'required',
            'contact' => 'required',
            'gender' => 'required',
            'role' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;

            if ($serviceMan->image) {
                unlink(public_path('images/' . $serviceMan->image));
            }
        }

        $serviceMan->update($data);

        return $serviceMan;
    }

    public function destroy($id)
    {
        $serviceMan = Smans::findOrFail($id);

        if ($serviceMan->image) {
            unlink(public_path('images/' . $serviceMan->image));
        }

        $serviceMan->delete();

        return response()->json(['message' => 'Record deleted successfully'], 200);
    }
}
