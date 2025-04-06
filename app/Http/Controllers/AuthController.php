<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return inertia('Login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Get values from config, not env directly
        $adminUsername = config('admin.username');
        $adminPassword = config('admin.password');

        if (
            $credentials['username'] === $adminUsername &&
            Hash::check($credentials['password'], $adminPassword)
        ) {

            // Store admin session with expiration
            $request->session()->put('admin_logged_in', true);

            return redirect('/admin/dashboard');
        }

        return back()->withErrors([
            'username' => 'Credenciais inválidas.',
        ]);
    }

    public function logout(Request $request)
    {
        $request->session()->forget('admin_logged_in');
        return redirect('/');
    }
}
