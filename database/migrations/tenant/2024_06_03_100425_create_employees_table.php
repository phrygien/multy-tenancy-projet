<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('employees', static function (Blueprint $table): void {
            $table->id();

            $table->unsignedBigInteger('current_salary')->default(0);

            $table
                ->foreignId('department_id')
                ->index()
                ->constrained('departments')
                ->cascadeOnDelete();

            $table
                ->foreignId('user_id')
                ->index()
                ->constrained('users')
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
