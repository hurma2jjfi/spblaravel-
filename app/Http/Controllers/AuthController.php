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
        'phone' => 'required|string|max:15',
        'password' => 'required|string|min:8|confirmed',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'password' => Hash::make($request->password),
    ]);

    return redirect()->route('login')->with('success', 'Регистрация прошла успешно!');
}

    public function showLoginForm()
    {
        return view('auth.login');
    }


#Laravel
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
            return redirect()->intended('user/dashboard')->with('success', 'Вы вошли в систему как пользователь!');
        }
    }

    return back()->withErrors(['email' => 'Неверные учетные данные.']);
}



#Vue js
// public function login(Request $request)
// {
//     // Валидация входящих данных
//     $request->validate([
//         'email' => 'required|string|email',
//         'password' => 'required|string',
//     ]);

//     // Пытаемся аутентифицировать пользователя
//     if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
//         // Получаем аутентифицированного пользователя
//         $user = Auth::user();

//         // Возвращаем данные пользователя в формате JSON
//         return response()->json([
//             'user' => $user,
//             'message' => 'Авторизация успешна!',
//         ], 200);
//     }

//     // Если аутентификация не удалась, возвращаем ошибку
//     return response()->json(['message' => 'Неверные учетные данные.'], 401);
// }


   

    public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
}

}

