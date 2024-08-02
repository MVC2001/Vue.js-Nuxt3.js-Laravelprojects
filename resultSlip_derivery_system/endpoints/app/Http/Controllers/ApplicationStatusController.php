<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sleep;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class ApplicationStatusController extends Controller
{
   
    public function fetchStatus()
    {
        try {
            // Get the logged-in student's ID
            $studentId = Auth::id();

            // Fetch the logged-in student's record
            $student = Student::find($studentId);
            if (!$student) {
                return response()->json(['error' => 'Student not found'], 404);
            }

            $studentName = $student->name;

            // Fetch records from rsleeps where status is 'sent' and name matches the logged-in student's name
            $sleeps = Sleep::where('status', 'sent')
                            ->where('name', $studentName)
                            ->get();

            return response()->json($sleeps, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch records'], 500);
        }
    }
}
