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
                return redirect()->intended('guru');
            } elseif ($users->level == 'tu') {
                return redirect()->intended('tu');
            }
        }

        return view('login.index');
    }
}
