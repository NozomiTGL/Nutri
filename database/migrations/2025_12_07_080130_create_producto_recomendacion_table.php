<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('producto_recomendacion', function (Blueprint $table) {
            $table->id();

            $table->foreignId('recomendacion_id')
                  ->constrained('recomendaciones')
                  ->onDelete('cascade');

            $table->foreignId('producto_id')
                  ->constrained('productos')
                  ->onDelete('cascade');

            $table->string('dosis')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('producto_recomendacion');
    }
};
