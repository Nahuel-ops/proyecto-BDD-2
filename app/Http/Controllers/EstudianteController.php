<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    // Muestra el formulario para crear un estudiante
    public function create()
    {
        return view('Estudiantes.create');
    }

    // Procesa el guardado aplicando las reglas de validación (Inciso A)
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:150',
            'email'  => 'required|email|max:150|unique:estudiantes,email',
            'ci'     => 'required|string|max:20|unique:estudiantes,ci', // Validación única para el CI
            'telef'  => 'nullable|string|max:20',
        ], [
            'ci.unique'   => 'La Cédula de Identidad (CI) ya se encuentra registrada en el sistema.',
            'email.unique'=> 'Este correo electrónico ya está en uso.',
        ]);

        Estudiante::create($request->all());

        return redirect()->route('inscripciones.create')
            ->with('success', 'Estudiante registrado con éxito. Ahora puede proceder con la inscripción.');
    }
}
