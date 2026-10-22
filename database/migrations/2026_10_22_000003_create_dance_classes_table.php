<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dance_classes', function (Blueprint $table) {
            $table->id();
            // An instructor with classes cannot be deleted (data integrity)
            $table->foreignId('instructor_id')->constrained()->restrictOnDelete();
            $table->string('name');
            $table->string('dance_style');
            $table->string('level')->default('Beginner');
            $table->decimal('fee', 8, 2);
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dance_classes');
    }
};
