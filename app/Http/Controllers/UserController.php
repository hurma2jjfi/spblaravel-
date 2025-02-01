<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function settings()
    {
        $user = Auth::user(); 
        return view('user.settings', compact('user')); 
    }

    public function update(Request $request)
{
    $user = Auth::user();

    if (!$user) {
        return redirect()->route('login')->with('error', 'Необходима авторизация.');
    }

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        'phone' => 'nullable|string|max:15', // Валидация для номера телефона
    ]);

    // Обновление данных пользователя
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->phone = $request->input('phone'); // Обновляем номер телефона

    if ($user->save()) {
        return redirect()->route('user.settings')->with('success', 'Данные успешно обновлены.');
    } else {
        return redirect()->route('user.settings')->with('error', 'Ошибка при обновлении данных.');
    }
}

    


    
}

