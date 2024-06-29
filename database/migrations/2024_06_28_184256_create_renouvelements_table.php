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
        Schema::create('renouvelements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('abonnement_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->date('date_renouvelement');
            $table->date('debut');
            $table->date('fin');
            $table->boolean('is_active');
            $table->integer('statut');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('renouvelements');
    }
};
