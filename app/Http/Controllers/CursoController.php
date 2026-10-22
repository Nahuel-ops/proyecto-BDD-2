<?php

namespace App\Http\Controllers;

use App\Http\Requests\CursoRequest;
use App\Models\Categoria;
use App\Models\curso;
use App\Models\Instructor;
use App\Models\Turnos;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function index(Request $request)
    {
        $cursos = curso::with(['categoria', 'instructors', 'turnos']) // <-- Cambiado de 'categorias' a 'categoria' (singular)
            ->when($request->filled('buscar'), fn ($q) => $q->where('name', 'ilike', '%'.$request->buscar.'%')) // <-- Cambiado de 'nombre' a 'name'
            ->when($request->filled('categoria_id'), fn ($q) => $q->where('categoria_id', $request->categoria_id))
            ->orderBy('id', 'asc')
            ->paginate(3)
            ->withQueryString();

        $categorias = Categoria::orderBy('name')->get();

        return view('curso.index', compact('cursos', 'categorias'));
    }

    public function create()
    {
        return view('curso.create', $this->datosFormulario() + ['curso' => new curso]);
    }

    public function store(CursoRequest $request)
    {
        $datos = $request->validated();

        if ($request->hasFile('imagen')) {
            $datos['imagen'] = $request->file('imagen')->store('img', 'public');
        } else {
            $datos['imagen'] = config('app.curso_imagen_default');
        }

        curso::create($datos);

        return redirect()->route('curso.index')
            ->with('success', 'Curso registrado correctamente.');
    }

    private function datosFormulario(): array
    {
        return [
            'categorias' => Categoria::orderBy('name')->get(),
            'instructores' => Instructor::orderBy('nombre')->get(),
            'turno' => Turnos::orderBy('turno')->orderBy('hora')->get(),
        ];
    }

    public function show($id)
    {
        $curso = curso::with(['categoria', 'instructors', 'turnos'])->findOrFail($id);

        return view('curso.show', compact('curso'));
    }
}
