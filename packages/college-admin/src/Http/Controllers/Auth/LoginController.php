<?php

namespace CollegeAdmin\Http\Controllers\Auth;

use CollegeAdmin\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('college-admin::admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $remember = $request->has('remember');

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ], $remember)) {
            $request->session()->regenerate();

            return redirect()->route('admin.dashboard');
        }

        return back()->with(
            'error',
            'Invalid Email or Password'
        );
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
