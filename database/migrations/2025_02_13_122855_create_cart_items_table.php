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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relación con users
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Relación con products
            $table->integer('quantity')->default(1);
            $table->decimal('price', 8, 2); // Precio unitario del producto
            $table->timestamps();

            // Índice único para evitar duplicados (un usuario solo puede tener un producto en el carrito una vez)
            $table->unique(['user_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
