<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
   public function index()
    {
        try {
            $vendors = Vendor::orderBy('id', 'desc')->get();
            return response()->json($vendors, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'vendorName' => 'required|max:255',
                'contact' => 'required|max:255',
                'address' => 'required|max:255',
                'gender' => 'required|max:255',
            ]);

            $vendor = Vendor::create($validated);
            return response()->json(['message' => 'Vendor created successfully', 'data' => $vendor], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function show($id)
    {
        try {
            $vendor = Vendor::findOrFail($id);
            return response()->json($vendor, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'vendorName' => 'sometimes|required|max:255',
                'contact' => 'sometimes|required|max:255',
                'address' => 'sometimes|required|max:255',
                'gender' => 'sometimes|required|max:255',
            ]);

            $vendor = Vendor::findOrFail($id);
            $vendor->update($validated);

            return response()->json(['message' => 'Vendor updated successfully', 'data' => $vendor], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $vendor = Vendor::findOrFail($id);
            $vendor->delete();
            return response()->json(['message' => 'Vendor deleted successfully', 'data' => $vendor], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}
