<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{


    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        $user = User::create($validatedData);

        return response()->json(['user' => $user], 201);
    }

  public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string|min:8',
    ]);

    if (!Auth::attempt($credentials)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    $user = $request->user();
    $token = $user->createToken('authToken')->plainTextToken;

    return response()->json(['user' => $user, 'token' => $token]);
}


    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out']);
    }


public function updatePassword(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'current_password' => 'required|string',
        'new_password' => 'required|string|min:8',
    ]);

    // Find the user by email
    $user = User::where('email', $request->email)->first();

    // Check if the user exists
    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }

    // Check if the current password matches the hashed password
    if (!password_verify($request->current_password, $user->password)) {
        return response()->json(['message' => 'Current password is incorrect'], 401);
    }

    // Update the password with the new hashed password
    $user->update([
        'password' => bcrypt($request->new_password),
    ]);

    return response()->json(['message' => 'Password updated successfully'], 200);
}



public function getLoggedUserName(Request $request)
{
    // Ensure the user is authenticated
    if (!$request->user()) {
        return response()->json(['message' => 'Unauthenticated'], 401);
    }

    $user = $request->user();

    // Return user's email
    return response()->json(['email' => $user->email]);
}



}
