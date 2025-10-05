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
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sucursal_id')->nullable();
            $table->string('imagen')->nullable();
            $table->string('titulo')->nullable();
            $table->string('descripcion')->nullable();
            $table->enum('tipo', ['principal', 'secundario', 'icono']);
            $table->enum('posicion', ['izquierda', 'centro', 'derecha'])->nullable();
            $table->enum('estado', ['activo', 'inactivo'])->default('activo');
            $table->timestamps();

            $table->foreign('sucursal_id')
                ->references('id')
                ->on('sucursales')
                ->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sliders');
    }
};
