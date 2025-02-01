<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo($request)
    {
        // Если пользователь пытается получить доступ к /excursions, возвращаем 404
        if ($request->is('excursions')) {
            throw new NotFoundHttpException();
        }

        // Для остальных маршрутов перенаправляем на страницу входа
        return route('login');
    }
}

