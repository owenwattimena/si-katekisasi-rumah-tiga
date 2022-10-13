<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Helpers\AlertFormatter;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function index()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            "username"  => "required",
            "password"  => "required"
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('/admin/dashboard');
        }
 
        return redirect()->back()->with(AlertFormatter::danger('Username atau Password salah!'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');

    }
}
