<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use Illuminate\Support\Facades\Auth;

class AdminLogin extends Controller
{
    public function loginUser(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            return response()->json(true);
        }

        return  response()->json(false);
    }

    public function signOut()
    {
        Auth::logout();
        return response()->json(true);
    }

    public function getEmail(Request $request)
    {
        $email = $request->email;
        return response()->json(["message" => "Email receive at backend"]);
    }
}
