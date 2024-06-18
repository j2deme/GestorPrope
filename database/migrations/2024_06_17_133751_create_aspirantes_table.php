<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('aspirantes', function (Blueprint $table) {
            $table->id();
            $table->string('ficha');
            $table->string('nombre');
            $table->string('curp');
            $table->string('carrera');
            $table->boolean('evaluado')->default(false);
            $table->integer('puntaje')->nullable();
            $table->dateTime('fecha_evaluacion')->nullable();
            $table->dateTime('fecha_seleccion')->nullable();
            $table->integer('periodo');
            $table->date('fecha_acceso')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aspirantes');
    }
};
