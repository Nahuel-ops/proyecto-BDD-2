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
    Schema::create('inscripciones', function (Blueprint $table) {
        $table->id();
        // Relación con estudiantes (borrado en cascada para mantener integridad)
        $table->foreignId('estudiante_id')->constrained('estudiantes')->onDelete('cascade');
        $table->date('fecha');
        $table->string('estado', 50)->default('Activo'); // Ej: Activo, Pendiente, Cancelado
        $table->decimal('nota', 5, 2)->nullable(); // Admite decimales para calificaciones (ej: 51.00 o 100.00)
        
        // Relación con la tabla Turnos/Horarios existente
        $table->foreignId('id_horario')->constrained('turnos')->onDelete('cascade'); 
        
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscripcions');
    }
};
