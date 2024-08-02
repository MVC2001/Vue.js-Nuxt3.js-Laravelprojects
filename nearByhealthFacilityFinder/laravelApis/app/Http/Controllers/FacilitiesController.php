<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facilities;

class FacilitiesController extends Controller
{

public function index()
{
    // Fetch facilities data ordered by their id
    $facilities = Facilities::orderBy('id')->get();

    // Return the facilities data as a JSON response
    return response()->json($facilities);
}


    public function show($id)
    {
        return Facilities::findOrFail($id);
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'place' => 'required',
                'category' => 'required',
                'service' => 'required',
                'description' => 'required',
                'contact' => 'required',
                'websiteLink' => 'nullable|url',
            ]);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $data['image'] = $imageName;
            }

            $facility = Facilities::create($data);

            return response()->json(['message' => 'Facility added successfully', 'facility' => $facility], 200);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $facility = Facilities::findOrFail($id);

        $data = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'place' => 'required',
            'category' => 'required',
            'service' => 'required',
            'description' => 'required',
            'contact' => 'required',
            'websiteLink' => 'nullable|url',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;

            if ($facility->image) {
                unlink(public_path('images/' . $facility->image));
            }
        }

        $facility->update($data);

        return $facility;
    }

   public function destroy($id)
{
    $facility = Facilities::findOrFail($id);

    // Check if the facility has an associated image
    if ($facility->image) {
        // If so, delete the image file from the directory
        unlink(public_path('images/' . $facility->image));
    }

    // Delete the facility record from the database
    $facility->delete();

    // Respond with a success message
    return response()->json(['message' => 'Facility deleted successfully'], 200);
}

}
