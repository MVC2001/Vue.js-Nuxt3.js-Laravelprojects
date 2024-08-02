<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {
        try {
            $students = Student::all();
            return response()->json($students, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error: ' . $e->getMessage()], 500);
        }
    }


   public function store(Request $request)
    {
        try {
            // Validate request data
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'course' => 'required|string|max:255',
                'email' => 'required|email|unique:students,email',
                'phone' => 'required|string|max:20'
            ]);

            // Create a new student
            $student = Student::create($validated);

            // Return success response
            return response()->json(['message' => 'Student created successfully', 'data' => $student], 201);
        } catch (\Exception $e) {
            // Return error response if validation fails or an exception occurs
            return response()->json(['error' => 'Internal Server Error: ' . $e->getMessage()], 500);
        }
    }

    public function show(Student $student)
    {
        try {
            return response()->json($student, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error: ' . $e->getMessage()], 500);
        }
    }

    public function update(Request $request, Student $student)
    {
        try {
            // Validate request data
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'course' => 'required|string|max:255',
                'email' => ['required', 'email', Rule::unique('students')->ignore($student->id)],
                'phone' => 'required|string|max:20'
            ]);

            // Update student
            $student->update($validated);

            // Return success response
            return response()->json(['message' => 'Student updated successfully', 'data' => $student], 200);
        } catch (\Exception $e) {
            // Return error response if validation fails or an exception occurs
            return response()->json(['error' => 'Internal Server Error: ' . $e->getMessage()], 500);
        }
    }

    public function destroy(Student $student)
    {
        try {
            $student->delete();
            return response()->json(['message' => 'Student deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error: ' . $e->getMessage()], 500);
        }
    }
}
