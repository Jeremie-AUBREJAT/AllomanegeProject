<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

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

            // Créer la table 'category'
            Schema::create('categories', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->string('name', 100);
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
        Schema::dropIfExists('categories');
    }
};
