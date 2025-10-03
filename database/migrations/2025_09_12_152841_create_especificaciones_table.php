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
        Schema::create('especificaciones', function (Blueprint $table) {
            $table->id();

            $table->string('descripcion');

            $table->unsignedBigInteger('tipo_id');
            $table->timestamps();

            $table->foreign('tipo_id')->references('id')->on('tipos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('especificaciones');
    }
};
