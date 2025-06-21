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
        Schema::create('planta_detalles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade');
            $table->enum('tipo', ['Interior', 'Exterior']);
            $table->enum('riego', ['Bajo', 'Moderado', 'Alto']);
            $table->enum('dificultad', ['Fácil', 'Media', 'Difícil']);
            $table->enum('luz', ['Directa', 'Indirecta']);
            $table->enum('fertilizacion', ['Semanal', 'Quincenal', 'Mensual', 'No requerida']);
            $table->boolean('tolerancia_invierno')->default(false);
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planta_detalles');
    }
};
