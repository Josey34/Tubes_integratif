<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;

use Laravel\Sanctum\HasApiTokens; // For Sanctum

class RegisterApiController extends Controller
{
    public function register(Request $request)
    {
        // dd("asu");
        $credentials = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::create([
            
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'password' => Hash::make($credentials['password']),
            'is_admin' => false
        ]);

        // create token
        $token = $user->createToken('auth_token')->plainTextToken;

        // return data and token
        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user,
            'token' => $token,
        ], 201);
    }
}
