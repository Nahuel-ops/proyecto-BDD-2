<?php

namespace App\Models;

use Database\Factories\CursoFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class curso extends Model
{
    /** @use HasFactory<CursoFactory> */
    use HasFactory;

    protected $fillable = [
        'categoria_id',
        'name',
        'descripcion',
        'imagen',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function instructors()
    {
        return $this->hasMany(Instructor::class);
    }

    public function turnos()
    {
        return $this->hasMany(Turnos::class);
    }

    public function getImagenUrlAttribute(): string
    {
        $imagen = $this->imagen ?: config('app.curso_imagen_default');

        return Storage::disk('public')->url($imagen);
    }
}
