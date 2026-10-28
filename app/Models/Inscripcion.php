<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inscripcion extends Model
{
    protected $table = 'inscripciones';

    protected $fillable = [
        'estudiante_id',
        'fecha',
        'estado',
        'nota',
        'id_horario',
    ];

    // Relación: Una inscripción pertenece a un estudiante
    public function estudiante(): BelongsTo
    {
        return $this->belongsTo(Estudiante::class, 'estudiante_id');
    }

    // Relación: Una inscripción pertenece a un turno/horario
    public function turno(): BelongsTo
    {
        return $this->belongsTo(Turnos::class, 'id_horario');
    }
}

