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
        Schema::create('productos_tipos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('producto_id');
            $table->unsignedBigInteger('tipo_id');
            $table->timestamps();

            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade');
            $table->foreign('tipo_id')->references('id')->on('tipos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos_tipos');
    }
};
