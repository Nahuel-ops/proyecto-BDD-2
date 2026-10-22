<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::orderBy('name')->paginate(10);

        return view('categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'name' => 'required|string|max:255|unique:categorias,name',
        ]);

        Categoria::create($datos);

        return redirect()->route('categorias.index')
            ->with('success', 'Categoría creada correctamente.');
    }
}
