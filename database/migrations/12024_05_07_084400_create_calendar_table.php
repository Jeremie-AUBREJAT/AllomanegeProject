<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('calendar', function (Blueprint $table) {
            $table->id();
            $table->dateTime('debut_date');
            $table->dateTime('fin_date');
            $table->unsignedBigInteger('carousel_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->foreign('carousel_id')->references('id')->on('carousels')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calendar');
    }
};
