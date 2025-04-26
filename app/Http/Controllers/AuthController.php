<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        echo $request->input('text_username');
        echo '<br />';
        echo $request->input('text_password');
    }

    public function logout()
    {
        return view('logout');
    }
}