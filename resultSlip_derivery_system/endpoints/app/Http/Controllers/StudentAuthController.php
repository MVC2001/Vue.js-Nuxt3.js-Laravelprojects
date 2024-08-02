<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class StudentAuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:students',
                'password' => 'required|string|min:8',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors(),
                ], Response::HTTP_BAD_REQUEST);
            }

            $student = Student::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return response()->json(['message' => 'Student registered successfully.'], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred during registration.',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors(),
                ], Response::HTTP_BAD_REQUEST);
            }

            if (!Auth::guard('student')->attempt($request->only('email', 'password'))) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized',
                ], Response::HTTP_UNAUTHORIZED);
            }

            $student = Auth::guard('student')->user();
            $token = $student->createToken('auth_token')->plainTextToken;

            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer'
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred during login.',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function user(Request $request)
    {
        try {
            return response()->json($request->user(), Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Unable to retrieve student data.',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();
            return response()->json(['message' => 'Successfully logged out'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred during logout.',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getAllStudents()
    {
        try {
            $students = Student::orderBy('id', 'desc')->get();
            return response()->json($students, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while fetching students.',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


}
