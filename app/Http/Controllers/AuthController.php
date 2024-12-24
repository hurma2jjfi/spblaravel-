<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Регистрация прошла успешно!');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string',
    ]);

    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        // Get the authenticated user
        $user = Auth::user();

        // Check user role and redirect accordingly
        if ($user->role === 'admin') {
            return redirect()->intended('excursions')->with('success', 'Вы вошли в систему как администратор!');
        } else {
            return redirect()->intended('user/dashboard')->with('success', 'Вы вошли в систему как пользователь!'); // Adjust this route as needed
        }
    }

    return back()->withErrors(['email' => 'Неверные учетные данные.']);
}


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Вы вышли из системы.');
    }
}

