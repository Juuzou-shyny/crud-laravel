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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nombre del producto
            $table->text('description')->nullable(); // Descripción detallada
            $table->decimal('price', 8, 2); // Precio del producto
            $table->string('image')->nullable(); // Ruta de la imagen principal
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade'); // Relación con categories
            $table->integer('stock')->default(0); // Stock disponible
            $table->enum('status', ['active', 'inactive'])->default('active'); // Estado del producto
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
