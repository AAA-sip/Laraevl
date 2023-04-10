<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login ()
    {
        return view('login');
    }

    public function index (Request $request)
    {
        $credentials = $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            Auth::user()->update(['last_login_at' => now()]);

            return redirect()->intended('/');
        }

        return back()->withErrors(['login' => 'Invalid login credentials.'])->withInput();
    }


}
