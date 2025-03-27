<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return inertia('Admin/Login');
    }

    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        if ($username === env('ADMIN_USERNAME') && Hash::check($password, env('ADMIN_PASSWORD'))) {
            session(['admin_logged_in' => true]);
            return redirect('/admin');
        }

        return redirect('admin/login')->withErrors(['Credenciais inválidas']);
    }

    public function logout()
    {
        session(['admin_logged_in' => false]);
        return redirect('/');
    }
}
