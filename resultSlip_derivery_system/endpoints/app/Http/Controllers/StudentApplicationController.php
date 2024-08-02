<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentApplication;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class StudentApplicationController extends Controller
{
    // List all student applications
    public function index()
    {
        return response()->json(StudentApplication::all(), 200);
    }

    // Show a specific student application
    public function show($id)
    {
        $application = StudentApplication::find($id);
        if ($application) {
            return response()->json($application, 200);
        }
        return response()->json(['message' => 'Application not found'], 404);
    }

    // Store a new student application
    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'index_number' => 'required|string|max:255',
            'year' => 'required|date',
            'clearance_form' => 'required|file|mimes:pdf|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Handle file upload
        $path = null;
        if ($request->hasFile('clearance_form')) {
            $file = $request->file('clearance_form');
            $path = $file->store('uploads', 'public');
        }

        // Store student record in the database
        StudentApplication::create([
            'name' => $request->input('name'),
            'index_number' => $request->input('index_number'),
            'year' => $request->input('year'),
            'clearance_form' => $path,
        ]);

        return response()->json(['message' => 'Application created successfully'], 201);
    }

    // Update an existing student application
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'index_number' => 'required|string|max:255',
            'year' => 'required|date',
            'clearance_form' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $application = StudentApplication::find($id);

        if (!$application) {
            return response()->json(['message' => 'Application not found'], 404);
        }

        // Handle file upload
        if ($request->hasFile('clearance_form')) {
            // Delete old file if exists
            if ($application->clearance_form) {
                Storage::disk('public')->delete($application->clearance_form);
            }

            $file = $request->file('clearance_form');
            $path = $file->store('uploads', 'public');
            $application->clearance_form = $path;
        }

        $application->name = $request->input('name');
        $application->index_number = $request->input('index_number');
        $application->year = $request->input('year');
        $application->save();

        return response()->json(['message' => 'Application updated successfully'], 200);
    }

    // Delete a student application
    public function destroy($id)
    {
        $application = StudentApplication::find($id);

        if (!$application) {
            return response()->json(['message' => 'Application not found'], 404);
        }

        // Delete file if exists
        if ($application->clearance_form) {
            Storage::disk('public')->delete($application->clearance_form);
        }

        $application->delete();
        return response()->json(['message' => 'Application deleted successfully'], 200);
    }

    // Get file URL
    public function getFileUrl($filename)
    {
        $url = Storage::disk('public')->url($filename);
        return response()->json(['url' => $url], 200);
    }

    // Download file
    public function downloadFile($filename)
    {
        return Storage::disk('public')->download($filename);
    }
}
