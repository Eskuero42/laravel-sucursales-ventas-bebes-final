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
        Schema::create('catalogos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('articulo_id');
            $table->unsignedBigInteger('tipo_id');
            $table->unsignedBigInteger('especificacion_id');
            $table->timestamps();

            $table->foreign('articulo_id')->references('id')->on('articulos')->onDelete('cascade');
            $table->foreign('tipo_id')->references('id')->on('tipos')->onDelete('cascade');
            $table->foreign('especificacion_id')->references('id')->on('especificaciones')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalogos');
    }
};
