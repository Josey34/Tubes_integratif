<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {

            $token = $request->user()->createToken('auth_token')->plainTextToken;

            return redirect('/');
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();

        Auth::logout();
        
        return redirect('/');
    }
}
