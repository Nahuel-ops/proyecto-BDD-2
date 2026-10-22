@extends('layaout/plantilla')
@section('title', 'Listado de Categorías')
@section('header')
    Gestión de Categorías
@endsection
@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex flex-wrap justify-between items-center mb-4 gap-4">
        <h2 class="text-xl font-bold">Categorías</h2>
        <div class="flex items-center gap-2">
            <a href="{{ route('home') }}" class="bg-cyan-600 hover:bg-cyan-700 text-white px-4 py-2 rounded">Volver al inicio</a>
            <a href="{{ route('categorias.create') }}" class="bg-green-500 text-white px-4 py-2 rounded">+ Nueva Categoría</a>
        </div>
    </div>

    <div class="bg-white shadow-md rounded overflow-hidden">
        <table class="min-w-full border-collapse">
            <thead>
                <tr class="bg-gray-200 text-left">
                    <th class="py-2 px-4 border-b">ID</th>
                    <th class="py-2 px-4 border-b">Nombre</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categorias as $categoria)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $categoria->id }}</td>
                    <td class="py-2 px-4 border-b">{{ $categoria->name }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $categorias->links() }}</div>
</div>
@endsection
