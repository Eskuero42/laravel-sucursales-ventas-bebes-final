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
        Schema::create('sucursales_categorias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sucursal_id');
            $table->unsignedBigInteger('categoria_id');
            $table->timestamps();

            $table->foreign('sucursal_id')->references('id')->on('sucursales')->onDelete('cascade');
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sucursales_categorias');
    }
};
