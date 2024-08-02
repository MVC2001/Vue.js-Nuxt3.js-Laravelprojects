<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AllRequests;

class AllrestedController extends Controller
{
    public function index()
    {
        try {
            $allRequests = AllRequests::all();
            return response()->json($allRequests, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error: ' . $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|max:255',
                'category' => 'required|max:255',
                'price' => 'required|numeric',
                'description' => 'required|max:255',
                'accountno' => 'required|numeric',
                'paymethod' => 'required|max:255',
                'amount' => 'required',
            ]);

            $allRequest = AllRequests::create($validated);
            return response()->json(['message' => 'Request item created successfully', 'data' => $allRequest], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error: ' . $e->getMessage()], 500);
        }
    }

    public function show(AllRequests $allRequest)
    {
        try {
            return response()->json($allRequest, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error: ' . $e->getMessage()], 500);
        }
    }

    public function update(Request $request, AllRequests $allRequest)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|max:255',
                'category' => 'required|max:255',
                'price' => 'required|numeric',
                'description' => 'required|max:255',
                'accountno' => 'required|numeric',
                'paymethod' => 'required|max:255',
                'amount' => 'required',
            ]);

            $allRequest->update($validated);
            return response()->json(['message' => 'Request item updated successfully', 'data' => $allRequest], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error: ' . $e->getMessage()], 500);
        }
    }

    public function destroy(AllRequests $allRequest)
    {
        try {
            $allRequest->delete();
            return response()->json(['message' => 'Request item deleted successfully', 'data' => $allRequest], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error: ' . $e->getMessage()], 500);
        }
    }
}
