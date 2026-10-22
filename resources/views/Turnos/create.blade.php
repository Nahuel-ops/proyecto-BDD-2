@extends('layaout/plantilla')
@section('title', 'Crear Turno')
@section('header')
    Registrar Turno
@endsection
@section('content')
<div class="container mx-auto px-4 py-6 max-w-lg">
    <form action="{{ route('turnos.store') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Turno (ej. Mañana / Noche):</label>
            <input type="text" name="turno" value="{{ old('turno') }}" class="border rounded w-full py-2 px-3 @error('turno') border-red-500 @enderror" required>
            @error('turno')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Hora:</label>
            <input type="time" name="hora" value="{{ old('hora') }}" class="border rounded w-full py-2 px-3" required>
        </div>

        <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded">Guardar Turno</button>
        <a href="{{ route('home') }}" class="text-blue-500 ml-4">Volver al inicio</a>
        <a href="{{ route('turnos.index') }}" class="text-blue-500 ml-4">Cancelar</a>
    </form>
</div>
@endsection
