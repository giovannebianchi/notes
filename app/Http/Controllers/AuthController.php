<?php

namespace App\Http\Controllers;

use App\Models\User;
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

       // Check if user exists
       $user = User::where('username', $username)
            ->where('deleted_at', NULL)
            ->first();

       if(!$user) {
        return redirect()
            ->back()
            ->withInput()
            ->with('loginError', 'Username ou senha incorretos!');
       }

       // Check if password is correct
       if(!password_verify($password, $user->password)) {
        return redirect()
            ->back()
            ->withInput()
            ->with('loginError', 'Username ou senha incorretos!');
       }

       // Update last login
       $user->last_login = date('Y-m-d H:i:s');
       $user->save();

       // Login user
       session([
        'user' => [
            'id' => $user->id,
            'username' => $user->username
        ]
       ]);

       echo 'Login com sucesso!';
    }

    public function logout()
    {
        // Logout from the application
        session()->forget('user');
        return redirect()->to('/login');
    }
}