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
        Schema::create('sucursales_articulos', function (Blueprint $table) {
            $table->id();
            $table->decimal('precio', 8, 2)->default(0);
            $table->integer('stock')->default(0);
            $table->decimal('descuento', 8, 2)->default(0);
            $table->tinyInteger('descuento_habilitado')->default(0);
            $table->tinyInteger('descuento_porcentaje')->default(0);
            $table->enum('estado', ['vigente', 'no vigente'])->default('vigente');
            $table->unsignedBigInteger('sucursales_categorias_id');
            $table->unsignedBigInteger('producto_id');
            $table->unsignedBigInteger('articulo_id')->nullable();
            $table->date('fecha_vencimiento')->nullable();
            $table->timestamps();

            $table->foreign('sucursales_categorias_id')->references('id')->on('sucursales_categorias')->onDelete('cascade');
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade');
            $table->foreign('articulo_id')->references('id')->on('articulos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sucursales_articulos');
    }
};
