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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname'); // Ajouter le prénom avec la possibilité d'être nul
            $table->string('compagny')->nullable(); // Ajouter le nom de la compagnie avec la possibilité d'être nul
            $table->string('email');
            $table->timestamp('email_verified_at');
            $table->string('password');
            $table->string('address'); // Ajouter l'adresse avec la possibilité d'être nul
            $table->string('zipcode'); // Ajouter le code postal avec la possibilité d'être nul
            $table->string('phone_number'); // Ajouter le numéro de téléphone avec la possibilité d'être nul
            $table->enum('role', ['user', 'admin', 'super_admin'])->default('user'); // Ajouter le rôle par default
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
