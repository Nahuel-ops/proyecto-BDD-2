<?php

namespace App\Http\Controllers;

use App\Models\Turnos;
use Illuminate\Http\Request;

class TurnosController extends Controller
{
    public function index()
    {
        $turnos = Turnos::orderBy('turno')->orderBy('hora')->paginate(10);

        return view('turnos.index', compact('turnos'));
    }

    public function create()
    {
        return view('turnos.create');
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'turno' => 'required|string|max:50',
            'hora' => 'required|date_format:H:i',
            'fecha' => 'nullable|date',
        ]);

        Turnos::create($datos);

        return redirect()->route('turnos.index')
            ->with('success', 'Turno registrado correctamente.');
    }
}
