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
        Schema::create('evaluaciones', function (Blueprint $table) {
            $table->id();

        // Cliente que llena la evaluación
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

        // Datos básicos (ajusta si tu maestra pidió otros)
            $table->decimal('peso', 5, 2);          // en kg, ej: 72.50
            $table->decimal('estatura', 5, 2);      // en m, ej: 1.65
            $table->string('objetivo');             // bajar de peso, ganar masa, etc.
            $table->string('actividad_fisica');     // baja, media, alta
            $table->text('restricciones')->nullable(); // alergias, enfermedades, etc.

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluaciones');
    }
};
