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
        Schema::create('productos', function (Blueprint $table) {
    $table->id();
    $table->string('nombre');
    $table->string('sku')->unique();
    $table->foreignId('categoria_id')->constrained('categorias');
    $table->decimal('precio_compra', 10, 2)->default(0);
    $table->decimal('precio_venta', 10, 2);
    $table->integer('stock')->default(0);
    $table->string('foto')->nullable();          // ← aquí guardamos la URL/patch de la imagen
    $table->boolean('publicado')->default(false);
    $table->timestamps();
    $table->softDeletes();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
