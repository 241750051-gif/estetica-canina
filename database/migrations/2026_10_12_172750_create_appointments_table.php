<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('pet_id')->constrained('pets')->onDelete('cascade');
            $table->date('appointment_date');
            $table->time('appointment_time');
            $table->enum('status', ['pendiente', 'confirmada', 'rechazada', 'atendida'])->default('pendiente');
            $table->text('notes')->nullable();
            $table->timestamps();
            
            // Indice unico para prevenir colisiones directas a nivel DB
            $table->unique(['appointment_date', 'appointment_time', 'status'], 'unique_confirmed_schedule');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};