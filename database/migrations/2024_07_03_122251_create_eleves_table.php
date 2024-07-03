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
        Schema::create('eleves', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenoms');
            $table->string('sexe');
            $table->string('date_naissance');
            $table->string('lieu_naissance');
            $table->string('adresse');
            $table->string('telephone')->unique()->nullable();
            $table->string('email')->unique();
            $table->string('matricule')->unique();
            $table->integer('age');
            $table->string('cin')->maxLength(12)->nullable();
            $table->foreignId('school_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('parent_id');
            $table->string('photo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eleves');
    }
};
