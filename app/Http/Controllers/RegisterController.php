<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required',
            'password' => 'required|min:8|max:255'
        ]);

        $validateData['passowrd'] = Hash::make($validateData['password']);

        User::create($validateData);

        return redirect('/login')->with('success', 'Succesfull!');
    }
}
