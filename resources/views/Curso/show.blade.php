@extends('layaout/plantilla')

@section('title', 'Detalles del Curso')

@section('header')
    Información del Curso
@endsection

@section('content')
<div class="container mx-auto px-4 py-6 max-w-3xl">

    <div class="bg-white shadow-md rounded-lg overflow-hidden p-6 mb-6">

        <!-- Encabezado del Curso -->
        <div class="border-b pb-4 mb-4 flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800">
                {{ $curso->nombre ?? $curso->name }}
            </h2>
            <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                ID: {{ $curso->id }}
            </span>
        </div>

        <!-- Imagen del Curso -->
               <!-- Imagen del Curso Forzada y Reparada -->
        <div class="mb-6 w-full h-64 md:h-80 bg-gray-200 rounded-lg overflow-hidden shadow-inner border border-gray-300 flex items-center justify-center">
           <img 
    src="{{ $curso->imagen_url ?? ($curso->imagen ? asset('storage/' . $curso->imagen) : asset('img/curso-default.png')) }}" 
    alt="Imagen del curso {{ $curso->nombre ?? $curso->name }}" 
    class="w-full h-full object-cover block"
    onerror="this.src='{{ asset('storage/img/curso-default.png') }}';"
>

        </div>


        <!-- Información General -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div>
                <p class="text-sm font-bold text-gray-500">Categoría:</p>
                <p class="text-lg text-gray-800 font-medium inline-flex items-center gap-2 mt-1">
                    <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                    {{ $curso->categoria ? $curso->categoria->name : 'Sin categoría' }}
                </p>
            </div>
        </div>

        <!-- Descripción -->
        <div class="mb-6">
            <p class="text-sm font-bold text-gray-500 mb-1">Descripción:</p>
            <p class="text-gray-700 bg-gray-50 p-4 rounded border leading-relaxed">
                {{ $curso->descripcion ?: 'No se ha proporcionado una descripción para este curso.' }}
            </p>
        </div>

        <!-- Instructores Asignados -->
        <div class="mb-6">
            <p class="text-sm font-bold text-gray-500 mb-2">Instructores:</p>
            @if(isset($curso->instructors) && $curso->instructors->count() > 0)
                <ul class="list-disc list-inside bg-gray-50 p-4 rounded border text-gray-700">
                    @foreach($curso->instructors as $instructor)
                        <li>{{ $instructor->nombre }} {{ $instructor->apellido }} ({{ $instructor->especialidad ?? 'Sin especialidad' }})</li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500 italic bg-gray-50 p-3 rounded border">No hay instructores asignados a este curso.</p>
            @endif
        </div>

        <!-- Turnos Registrados -->
        <div class="mb-6">
            <p class="text-sm font-bold text-gray-500 mb-2">Turnos y Horarios:</p>
            @if(isset($curso->turnos) && $curso->turnos->count() > 0)
                <div class="overflow-x-auto rounded border border-gray-200">
                    <table class="min-w-full border-collapse text-sm">
                        <thead>
                            <tr class="bg-gray-100 text-left text-gray-700">
                                <th class="border-b border-gray-200 px-4 py-3">Turno</th>
                                <th class="border-b border-gray-200 px-4 py-3">Hora</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($curso->turnos as $turno)
                                <tr class="hover:bg-gray-50">
                                    <td class="border-b border-gray-200 px-4 py-2 font-medium">{{ $turno->turno }}</td>
                                    <td class="border-b border-gray-200 px-4 py-2 text-gray-600">{{ $turno->hora }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-gray-500 italic bg-gray-50 p-3 rounded border">No hay turnos registrados para este curso.</p>
            @endif
        </div>

        <!-- Botones de Acción -->
        <div class="flex flex-wrap items-center justify-between border-t border-gray-200 pt-5 mt-6 gap-4">
            <div class="flex gap-3">
                <a href="{{ route('home') }}" class="bg-cyan-600 hover:bg-cyan-700 text-white font-bold py-2 px-4 rounded shadow transition">
                    Inicio
                </a>
                <a href="{{ route('curso.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded shadow transition">
                    Volver al Listado
                </a>
            </div>

            <div class="flex gap-2">
                {{-- <a href="{{ route('curso.edit', $curso->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded shadow transition">Editar Curso</a> --}}
            </div>
        </div>

    </div>

</div>
@endsection
