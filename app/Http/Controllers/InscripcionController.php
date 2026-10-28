<?php

namespace App\Http\Controllers;

use App\Models\Inscripcion;
use App\Models\Estudiante;
use App\Models\Turnos; // Asegúrate de mapear tu modelo de Turnos u Horarios correctamente
use Illuminate\Http\Request;

class InscripcionController extends Controller
{
    // Inciso D: Listar estudiantes inscritos con sus relaciones
    public function index()
    {
        // Traemos las inscripciones cargando los datos del estudiante y el turno en una sola consulta
        $inscripciones = Inscripcion::with(['estudiante', 'turno'])->orderBy('fecha', 'desc')->get();
        
        return view('Inscripciones.index', compact('inscripciones'));
    }

    // Formulario de inscripción (Carga estudiantes y turnos para los selects del formulario)
    public function create()
    {
        $estudiantes = Estudiante::orderBy('nombre', 'asc')->get();
        $turnos = Turnos::orderBy('turno', 'asc')->get(); // Cambiar por el campo descriptor de tus turnos (ej: 'dia_turno')
        
        return view('Inscripciones.create', compact('estudiantes', 'turnos'));
    }

    // Inciso B: Insertar una Inscripción
    public function store(Request $request)
    {
        $request->validate([
            'estudiante_id' => 'required|exists:estudiantes,id',
            'id_horario'    => 'required|exists:turnos,id',
            'estado'        => 'required|string|max:50',
        ]);

        Inscripcion::create([
            'estudiante_id' => $request->estudiante_id,
            'id_horario'    => $request->id_horario,
            'fecha'         => date('Y-m-d'), // Asigna la fecha actual del servidor automáticamente
            'estado'        => $request->estado,
            'nota'          => null, // Nace sin nota asignada inicialmente
        ]);

        return redirect()->route('inscripciones.index')
            ->with('success', 'Inscripción procesada correctamente.');
    }

    // Formulario para editar la nota (Inciso C)
    public function edit($id)
    {
        $inscripcion = Inscripcion::with('estudiante')->findOrFail($id);
        return view('Inscripciones.edit', compact('inscripcion'));
    }

    // Inciso C: Actualizar la nota de la inscripción
    public function update(Request $request, $id)
    {
        $request->validate([
            'nota' => 'required|numeric|min:0|max:100', // Validación de rango académico estándar (0 - 100)
        ], [
            'nota.required' => 'Es obligatorio ingresar una calificación.',
            'nota.max'      => 'La nota máxima permitida es de 100 puntos.',
        ]);

        $id_inscripcion = Inscripcion::findOrFail($id);
        $id_inscripcion->update([
            'nota' => $request->nota
        ]);

        return redirect()->route('inscripciones.index')
            ->with('success', 'La calificación fue actualizada correctamente.');
    }
}
