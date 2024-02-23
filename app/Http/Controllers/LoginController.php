<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function index() 
    {
        return view('pages.auth.login');
    }

    public function login_proses(Request $request) {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (Auth::user()->id_level == 1) {
                return redirect()->route('dashboard-management');
            } elseif (Auth::user()->id_level == 2) {
                return redirect()->route('dashboard-guru');
            }
        }
        return redirect()->route('login')->with(['error' => true]);
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

}
