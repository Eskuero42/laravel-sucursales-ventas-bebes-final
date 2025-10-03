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
        Schema::create('posiciones', function (Blueprint $table) {
            $table->id();
            $table->string('imagen');
            $table->unsignedBigInteger('articulo_id');
            $table->timestamps();

            $table->foreign('articulo_id')->references('id')->on('articulos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posiciones');
    }
};
