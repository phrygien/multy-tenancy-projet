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
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('school_name');
            $table->string('abreviation');
            $table->string('identity')->unique();
            $table->string('url');
            $table->string('tenant_id');
            $table->string('telephone_phixe')->nullable()->unique();
            $table->string('telephone_mobile')->unique();
            $table->string('email')->unique();
            $table->string('province_id');
            $table->integer('region_id');
            $table->integer('district_id');
            $table->integer('commune_id')->nullable();
            $table->string('adresse');
            $table->boolean('is_published')->default(true);
            $table->integer('user_id');
            $table->text('logo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schools');
    }
};
