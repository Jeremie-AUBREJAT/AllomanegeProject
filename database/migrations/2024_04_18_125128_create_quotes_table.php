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

        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('message');
            $table->unsignedBigInteger('carousel_id');
            $table->foreign('carousel_id')->references('id')->on('carousels');
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
        Schema::dropIfExists('quotes');
    }
};
