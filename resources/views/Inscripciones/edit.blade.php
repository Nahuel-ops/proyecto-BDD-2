@extends('layaout.plantilla')

@section('contenido')
<div class="max-w-md mx-auto mt-12 bg-white p-6 rounded-lg shadow-md border border-gray-100">
    <div class="border-b pb-4 mb-4">
        <h2 class="text-xl font-bold text-gray-800">Asignar Calificación</h2>
        <p class="text-sm text-gray-600 mt-1">
            Estudiante: <span class="font-bold text-gray-900">{{ $inscripcion->estudiante->nombre }}</span>
        </p>
        <p class="text-xs text-gray-500">CI: {{ $inscripcion->estudiante->ci }}</p>
    </div>

    <form action="{{ route('inscripciones.update', $inscripcion->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Calificación Final (0.00 - 100.00)</label>
            <input type="number" step="0.01" name="nota" value="{{ old('nota', $inscripcion->nota) }}" required min="0" max="100"
                   class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border transition font-mono text-lg text-center"
                   placeholder="0.00">
            @error('nota')
                <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end space-x-2 pt-2 border-t">
            <a href="{{ route('inscripciones.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 py-2 px-4 rounded transition text-sm font-medium">
                Cancelar
            </a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded transition text-sm font-semibold shadow-sm">
                Actualizar Nota
            </button>
        </div>
    </form>
</div>
@endsection
