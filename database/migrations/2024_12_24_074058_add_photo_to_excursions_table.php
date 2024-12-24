<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPhotoToExcursionsTable extends Migration
{
    public function up()
    {
        Schema::table('excursions', function (Blueprint $table) {
            $table->string('photo')->nullable(); // Add a nullable column for photo
        });
    }

    public function down()
    {
        Schema::table('excursions', function (Blueprint $table) {
            $table->dropColumn('photo'); // Remove the photo column if rolled back
        });
    }
}

