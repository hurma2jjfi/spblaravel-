<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    public function up()
    {
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
        Schema::dropIfExists('bookings');
    }
}

