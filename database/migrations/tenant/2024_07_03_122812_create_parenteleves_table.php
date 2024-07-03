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
        Schema::create('parenteleves', function (Blueprint $table) {
            $table->id();
            $table->string('nom_prenom_pere');
            $table->string('nom_prenom_mere');
            $table->string('telephone')->unique();
            $table->string('email')->unique();
            $table->string('adresse');
            $table->string('fonction_pere')->nullable();
            $table->string('fonction_mere')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parenteleves');
    }
};
