<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExcursionsTable extends Migration
{
    public function up()
    {
        Schema::create('excursions', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Название экскурсии
            $table->text('description'); // Описание экскурсии
            $table->decimal('price', 8, 2); // Цена экскурсии
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('excursions');
    }
}

