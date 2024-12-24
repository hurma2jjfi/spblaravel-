<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDurationToExcursionsTable extends Migration
{
    public function up()
    {
        Schema::table('excursions', function (Blueprint $table) {
            $table->integer('duration')->nullable(); // Длительность экскурсии в минутах
        });
    }

    public function down()
    {
        Schema::table('excursions', function (Blueprint $table) {
            $table->dropColumn('duration');
        });
    }
}

