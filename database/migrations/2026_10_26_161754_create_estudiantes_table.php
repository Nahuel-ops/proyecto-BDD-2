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
    Schema::create('estudiantes', function (Blueprint $table) {
        $table->id();
        $table->string('nombre', 150);
        $table->string('email', 150)->unique();
        $table->string('ci', 20)->unique(); // Clave para la validación única solicitada
        $table->string('telef', 20)->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudiantes');
    }
};
