@extends('layaout.plantilla')

@section('header', 'Bienvenidos a mi sitio web')

@section('content')
<div class="max-w-2xl mx-auto mt-8 bg-white p-6 rounded-lg shadow-md border border-gray-100 mb-8">
    <div class="flex justify-between items-center mb-6 border-b pb-4">
        <h2 class="text-2xl font-bold text-gray-800">Nueva Inscripción Academicas</h2>
        <div class="space-x-2">
            <a href="{{ route('estudiantes.create') }}" class="text-sm bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded transition shadow-sm font-medium">
                + Registrar Estudiante
            </a>
            <a href="{{ route('inscripciones.index') }}" class="text-sm bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded transition shadow-sm">
                Cancelar
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded text-sm shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('inscripciones.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Seleccionar Estudiante</label>
            <select name="estudiante_id" required class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border transition">
                <option value="">-- Busque o Seleccione un Alumno --</option>
                @foreach($estudiantes as $estudiante)
                    <option value="{{ $estudiante->id }}" {{ old('estudiante_id') == $estudiante->id ? 'selected' : '' }}>
                        {{ $estudiante->nombre }} (CI: {{ $estudiante->ci }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Asignar Turno / Horario</label>
                <select name="id_horario" required class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border transition">
                    <option value="">-- Elija un Horario --</option>
                    @foreach($turnos as $turno)
                        <option value="{{ $turno->id }}" {{ old('id_horario') == $turno->id ? 'selected' : '' }}>
                            {{ $turno->turno }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Estado Matriculación</label>
                <select name="estado" required class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border transition">
                    <option value="Activo" {{ old('estado') == 'Activo' ? 'selected' : '' }}>Activo</option>
                    <option value="Pendiente" {{ old('estado') == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                </select>
            </div>
        </div>

        <div class="pt-4 flex justify-end">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-md shadow transition duration-150">
                Procesar Inscripción
            </button>
        </div>
    </form>
</div>
@endsection
