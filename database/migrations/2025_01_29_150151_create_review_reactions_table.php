<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('review_reactions', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('excursion_id'); // Изменено на excursion_id
        $table->unsignedBigInteger('user_id');
        $table->string('emoji');
        $table->timestamps();

        // Внешние ключи
        $table->foreign('excursion_id')->references('id')->on('excursions')->onDelete('cascade');
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        
        // Уникальность реакции пользователя
        $table->unique(['excursion_id', 'user_id', 'emoji']);
    });
}



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('review_reactions');
    }
};
