@extends('layaout.plantilla')

@section('header', 'Bienvenidos a mi sitio web')

@section('content')
<!-- Barra de Menú de Navegación Interna (Solo el contenido del cuerpo, sin duplicar cabeceras) -->
<div class="flex flex-col md:flex-row justify-between items-center my-6 gap-4">
    <div class="flex flex-wrap gap-2">
        <a href="{{ route('home') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded transition text-sm">
            Inicio
        </a>
        <a href="{{ route('curso.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded transition text-sm">
            Cursos
        </a>
    </div>
    
    <div class="flex items-center gap-4">
        <a href="{{ route('inscripciones.create') }}" class="bg-emerald-500 hover:bg-emerald-600 text-white font-semibold py-2 px-4 rounded transition text-sm">
            + Nueva Inscripción
        </a>
        <a href="{{ route('estudiantes.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded transition text-sm">
            + Nuevo Estudiante
        </a>
    </div>
</div>

<!-- Contenedor del Listado Estético -->
<div class="bg-white p-6 rounded-lg shadow-md border border-gray-100 mb-8">
    <div class="mb-4">
        <h2 class="text-xl font-bold text-gray-800">Control de Estudiantes Inscritos</h2>
        <p class="text-xs text-gray-500">Registros activos en la base de datos "we2"</p>
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded text-sm shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto rounded-lg border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Estudiante / CI</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Contacto</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Fecha Inscr.</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Turno / Horario</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Estado</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Nota Final</th>
                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 text-sm">
                @forelse($inscripciones as $inscripcion)
                    <tr class="hover:bg-gray-50 transition duration-75">
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500 font-mono">
                            {{ $inscripcion->id }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="font-bold text-gray-900">{{ $inscripcion->estudiante->nombre }}</div>
                            <div class="text-xs text-gray-500 font-mono">CI: {{ $inscripcion->estudiante->ci }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-gray-900">{{ $inscripcion->estudiante->email }}</div>
                            <div class="text-xs text-gray-500">{{ $inscripcion->estudiante->telef ?? 'Sin registro' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600 font-mono">
                            {{ \Carbon\Carbon::parse($inscripcion->fecha)->format('d/m/Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-700 font-medium">
                            {{ $inscripcion->turno->turno ?? 'Sin horario' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2.5 py-0.5 inline-flex text-xs leading-5 font-bold rounded-full 
                                {{ $inscripcion->estado === 'Activo' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $inscripcion->estado }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap font-bold text-base font-mono">
                            @if(is_null($inscripcion->nota))
                                <span class="text-gray-400 font-normal text-sm italic">Sin nota</span>
                            @else
                                <span class="{{ $inscripcion->nota >= 51 ? 'text-green-600' : 'text-red-600' }}">
                                    {{ number_format($inscripcion->nota, 2) }}
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                            <a href="{{ route('inscripciones.edit', $inscripcion->id) }}" 
                               class="text-blue-600 hover:text-blue-900 font-bold transition">
                                Calificar
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-12 text-center text-gray-400 bg-gray-50">
                            <p class="text-base font-medium">No hay registros cargados en la tabla</p>
                            <p class="text-xs mt-1">Usa los botones superiores para registrar estudiantes e inscripciones.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
