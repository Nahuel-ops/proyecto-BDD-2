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
        Schema::create('turnos', function (Blueprint $table) {
            $table->id();

            // Relación de 1 a Muchos: Curso -> Turnos (Un curso tiene muchos turnos/horarios)
            $table->foreignId('curso_id')
                  ->constrained('cursos')
                  ->onDelete('cascade');

            $table->string('turno');
            $table->time('hora');
            $table->date('fecha');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('turnos');
    }
};
