<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        return view('login');
    }

    public function loginSubmit(Request $request)
    {
        // Form validation
        $request->validate(
           // Rules
            [
                'text_username' => 'required|email',
                'text_password' => 'required|min:6|max:16'
            ],
            // Error messages
            [
                'text_username.required' => 'O campo de usuário é obrigatório',
                'text_username.email' => 'O campo de usuário deve ser um e-mail válido',
                'text_password.required' => 'O campo de senha é obrigatório',
                'text_password.min' => 'A senha deve ter no mínimo :min caracteres',
                'text_password.max' => 'A senha deve ter no mínimo :max caracteres'
            ]
        );

        // Get user input
        $username = $request->input('text_username');
        $password = $request->input('text_password');

        // Test database connection
        try {
            DB::connection()->getPDO();
            echo "Connection is OK!";
        } catch (\PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

        echo "Fim!";
    }

    public function logout()
    {
        return view('logout');
    }
}