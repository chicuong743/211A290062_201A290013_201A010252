<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class loginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function check_login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('home');
        }
        else{
            return redirect()->back()->withErrors(['email' => 'Email hoặc mật khẩu không chính xác.']);
        }

    }
}
