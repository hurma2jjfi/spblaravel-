<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        // Валидация данных формы
        $request->validate([
            'surname' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'patronymic' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'date' => 'required|date',
            'excursion' => 'required|string|max:255',
        ]);

        try {
            // Создание нового бронирования
            Booking::create([
                'surname' => $request->surname,
                'name' => $request->name,
                'patronymic' => $request->patronymic,
                'phone' => $request->phone,
                'email' => $request->email,
                'date' => $request->date,
                'excursion' => $request->excursion,
            ]);

            // Сообщение об успехе
            return redirect()->back()->with('success', 'Бронирование успешно создано! Мы свяжемся с вами для подтверждения.');
        } catch (\Exception $e) {
            // Сообщение об ошибке
            return redirect()->back()->with('error', 'Произошла ошибка при создании бронирования. Пожалуйста, попробуйте снова.');
        }
    }
}

