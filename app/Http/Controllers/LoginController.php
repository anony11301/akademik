<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function index() 
    {
        if ($users = Auth::user()) {
            if ($users->level == '') {
                return redirect()->intended('1');
            } elseif ($users->level == '2') {
                return redirect()->intended('2');
            }
        }

        return view('login.index');
    }
}
