<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    use HasFactory;

    protected $fillable = [
        'curso_id',
        'nombre',
        'apellido',
        'email',
        'especialidad',
        'activo'
    ];

    public function curso()
    {
        return $this->belongsTo(curso::class);
    }
}
