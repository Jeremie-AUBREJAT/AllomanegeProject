<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        DB::beginTransaction();

        try {
            // Désactiver les contraintes de clé étrangère
            DB::statement('SET FOREIGN_KEY_CHECKS=0');

        Schema::create('carousels', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name', 100);
            $table->decimal('length', 15, 2);
            $table->decimal('width', 15, 2);
            $table->integer('weight',15,2);
            $table->integer('watt_power');
            $table->decimal('install_time', 15, 2);
            $table->text('description');
            $table->string('street_number')->nullable(20);
            $table->string('street_name')->nullable(100);
            $table->string('postal_code')->nullable(20);
            $table->string('city')->nullable(100);
            $table->string('country')->nullable(100);
            $table->decimal('price', 15, 2);
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->unsignedBigInteger('picture_id')->nullable();
            $table->foreign('picture_id')->references('id')->on('pictures');
            $table->unsignedBigInteger('quote_id')->nullable()->default(null);
            $table->foreign('quote_id')->references('id')->on('quotes');
            $table->unsignedBigInteger('user_id')->nullable()->default(null);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
        });
   // Réactiver les contraintes de clé étrangère
   DB::statement('SET FOREIGN_KEY_CHECKS=1');

   DB::commit();
} catch (\Exception $e) {
   // En cas d'erreur, annuler la transaction
   DB::rollback();
   throw $e;
}
}

/**
* Reverse the migrations.
*/
public function down(): void
    {
        Schema::dropIfExists('carousels');
    }
};
