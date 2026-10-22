@extends('layaout/plantilla')
@section('title', 'Crear Categoría')
@section('header')
    Registrar Categoría
@endsection
@section('content')
<div class="container mx-auto px-4 py-6 max-w-lg">
    <form action="{{ route('categorias.store') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Nombre de la Categoría:</label>
            <input type="text" name="name" value="{{ old('name') }}" class="border rounded w-full py-2 px-3 @error('name') border-red-500 @enderror" required>
            @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded">Guardar</button>
        <a href="{{ route('home') }}" class="text-blue-500 ml-4">Volver al inicio</a>
        <a href="{{ route('categorias.index') }}" class="text-blue-500 ml-4">Cancelar</a>
    </form>
</div>
@endsection
