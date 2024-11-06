<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Handle user registration
    public function register(Request $request)
    {
        // Validate the incoming request data
//        $validator = Validator::make($request->all(), [
//            'name' => 'required|string|max:255',
//            'email' => 'required|string|email|max:255|unique:users',
//            'dob' => 'required|date',
//            'mobile' => 'required|string|max:15|unique:users',
//            'password' => 'required|string|min:6|confirmed',
//            'gender' => 'required|string|max:10',
//        ]);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'dob' => 'required|date',
            'mobile' => 'required|string|max:15', // Adjust based on your requirements
            'gender' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

//        if ($validator->fails()) {
//            return response()->json(['error' => $validator->errors()], 400);
//        }

        // Create a new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'dob' => $request->dob,
            'mobile' => $request->mobile,
            'password' => Hash::make($request->password), // Hash the password
            'gender' => $request->gender,
        ]);

        // Generate a token (you can use Laravel Passport or Sanctum for this)
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['access_token' => $token, 'token_type' => 'Bearer'], 201);
    }
    public function login(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Find the user by email
        $user = User::where('email', $request->email)->first();

        // Check if user exists and if password is correct
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Generate a token
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['access_token' => $token, 'token_type' => 'Bearer'], 200);
    }
    public function logout(Request $request)
    {
        // Get the currently authenticated user
        $user = $request->user();

        // Revoke the token that was used for the request
        $user->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully'], 200);
    }

}
