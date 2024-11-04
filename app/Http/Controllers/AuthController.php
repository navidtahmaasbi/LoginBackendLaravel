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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'dob' => 'required|date',
            'mobile' => 'required|string|max:15|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'gender' => 'required|string|max:10',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

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
}
