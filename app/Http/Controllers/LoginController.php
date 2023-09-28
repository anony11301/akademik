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
        $request->validate([
            'email'     => 'required',
            'password'  => 'required',
        ]);

        $data = [
            'email'     => $request->email,
            'password'  => $request->password
        ];

        if(Auth::attempt($data)) {
            return redirect()->route('management.dashboard-management-kelas');
        }else {
            return redirect()->route('login');
        };
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }

}
