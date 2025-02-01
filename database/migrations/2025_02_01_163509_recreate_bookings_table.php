<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RecreateBookingsTable extends Migration
{
    public function up()
    {
        // Удаляем таблицу bookings, если она существует
        Schema::dropIfExists('bookings');

        // Создаем новую таблицу bookings
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('surname'); // Фамилия
            $table->string('name'); // Имя
            $table->string('patronymic'); // Отчество
            $table->string('phone'); // Номер телефона
            $table->string('email'); // Электронная почта
            $table->date('date'); // Дата экскурсии
            $table->string('excursion'); // Экскурсия
            $table->timestamps(); // Временные метки created_at и updated_at
        });
    }

    public function down()
    {
        // Удаляем таблицу bookings при откате миграции
        Schema::dropIfExists('bookings');
    }
}
