<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function index() 
    {
        return view('login.index');
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
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (Auth::user()->id_level == 1) {
                return redirect()->route('dashboard-management');
            }
        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }

}
