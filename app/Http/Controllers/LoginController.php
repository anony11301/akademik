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
        // $request->validate([
        //     'email'     => 'required',
        //     'password'  => 'required',
        // ]);

        // $data = [
        //     'email'     => $request->email,
        //     'password'  => $request->password
        // ];

        // if(Auth::attempt($data)) {
        //     return redirect()->route('dashboard-management');
        // }else {
        //     return redirect()->route('login');
        // };
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
        return redirect()->route('login');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

}
