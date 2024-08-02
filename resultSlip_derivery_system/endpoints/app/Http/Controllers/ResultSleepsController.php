<?php

namespace App\Http\Controllers;

use App\Models\Sleep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ResultSleepsController extends Controller
{
    public function index()
{
    try {
        // Fetch records where status is NULL or an empty string
        $sleeps = Sleep::whereNull('status')
                        ->orWhere('status', '')
                        ->get();

        // Return the records with a 200 OK status
        return response()->json($sleeps, 200);
    } catch (\Exception $e) {
        // Return a 500 error with a message if something goes wrong
        return response()->json(['error' => 'Failed to fetch records'], 500);
    }
}



   public function history()
{
    try {
        $sleeps = Sleep::where('status', 'sent')->get();
        return response()->json($sleeps, 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Failed to fetch records'], 500);
    }
}

public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'file' => 'required|mimes:pdf|max:2048',
        'index_number' => 'required|string|max:255',
        'year' => 'required|integer|digits:4',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    try {
        $file = $request->file('file');
        $filePath = $file->store('uploads', 'public');

        $sleep = Sleep::create([
            'name' => $request->name,
            'file' => $filePath,
            'index_number' => $request->index_number,
            'year' => $request->year,
        ]);

        return response()->json($sleep, 201);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Failed to create record'], 500);
    }
}

    public function show($id)
    {
        try {
            $sleep = Sleep::findOrFail($id);
            return response()->json($sleep, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Record not found'], 404);
        }
    }

 public function update(Request $request, $id)
{
    $validator = Validator::make($request->all(), [
        'name' => 'sometimes|required|string|max:255',
        'file' => 'sometimes|required|mimes:pdf|max:2048',
        'index_number' => 'sometimes|required|string|max:255',
        'year' => 'sometimes|required|integer|digits:4',
        'status' => 'sometimes|required', // Correct validation for status
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    try {
        $sleep = Sleep::findOrFail($id);

        if ($request->hasFile('file')) {
            // Delete the old file
            Storage::disk('public')->delete($sleep->file);

            // Store the new file
            $file = $request->file('file');
            $filePath = $file->store('uploads', 'public');
            $sleep->file = $filePath;
        }

        $sleep->update($request->only(['name', 'index_number', 'year', 'status']));

        return response()->json($sleep, 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Failed to update record'], 500);
    }
}


    public function destroy($id)
    {
        try {
            $sleep = Sleep::findOrFail($id);

            // Delete the file
            Storage::disk('public')->delete($sleep->file);

            $sleep->delete();
            return response()->json(['message' => 'Record deleted'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete record'], 500);
        }
    }
}
