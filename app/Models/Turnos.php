<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turnos extends Model
{
    use HasFactory;

    protected $fillable = [
        'curso_id',
        'turno',
        'hora',
        'fecha',
    ];

    public function curso()
    {
        return $this->belongsTo(curso::class);
    }
}
