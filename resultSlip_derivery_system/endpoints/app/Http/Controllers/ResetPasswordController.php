<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Http\Response;

class ResetPasswordController extends Controller
{
    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|confirmed|min:8', // This requires password_confirmation field
        ]);

        if ($validator->fails()) {
            return response()->json([
                'response' => Response::HTTP_BAD_REQUEST,
                'success' => false,
                'message' => $validator->errors()->first(), // Show specific validation error
            ], Response::HTTP_BAD_REQUEST);
        }

        try {
            $user = User::where('email', $request->email)->first();
            if (!$user) {
                return response()->json([
                    'response' => Response::HTTP_BAD_REQUEST,
                    'success' => false,
                    'message' => 'User not found',
                ], Response::HTTP_BAD_REQUEST);
            }

            $user->password = Hash::make($request->password);
            $user->save();

            return response()->json([
                'response' => Response::HTTP_OK,
                'success' => true,
                'message' => 'Password updated successfully',
            ], Response::HTTP_OK);
            
        } catch (\Exception $e) {
            return response()->json([
                'response' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'success' => false,
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
