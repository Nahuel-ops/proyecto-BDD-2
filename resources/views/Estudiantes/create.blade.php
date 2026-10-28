@extends('layaout.plantilla')

@section('header', 'Bienvenidos a mi sitio web')

@section('content')
<!-- Barra de Menú de Navegación Interna Cohesiva -->
<div class="flex flex-col md:flex-row justify-between items-center my-6 gap-4">
    <div class="flex flex-wrap gap-2">
        <a href="{{ route('home') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded transition text-sm">
            Inicio
        </a>
        <a href="{{ route('curso.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded transition text-sm">
            Cursos
        </a>
        <a href="{{ route('inscripciones.index') }}" class="bg-gray-700 hover:bg-gray-800 text-white font-medium py-2 px-4 rounded transition text-sm">
            Volver al Listado
        </a>
    </div>
</div>

<div class="max-w-2xl mx-auto mt-4 bg-white p-6 rounded-lg shadow-md border border-gray-100 mb-8">
    <div class="flex justify-between items-center mb-6 border-b pb-4">
        <h2 class="text-2xl font-bold text-gray-800">Registrar Nuevo Estudiante</h2>
    </div>

    {{-- Bloque de Alertas para Errores de Validación (Como el CI Único) --}}
    @if ($errors->any())
        <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded text-sm shadow-sm">
            <p class="font-bold mb-1">Por favor, corrige los siguientes problemas:</p>
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('estudiantes.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Nombre Completo</label>
            <input type="text" name="nombre" value="{{ old('nombre') }}" required 
                   class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border transition">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Cédula de Identidad (CI)</label>
                <input type="text" name="ci" value="{{ old('ci') }}" required 
                   class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border transition"
                       placeholder="Ej: 8432111">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Teléfono / Celular</label>
                <input type="text" name="telef" value="{{ old('telef') }}" 
                   class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border transition"
                       placeholder="Ej: 71234567">
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Correo Electrónico</label>
            <input type="email" name="email" value="{{ old('email') }}" required 
                   class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border transition"
                   placeholder="ejemplo@academia.test">
        </div>

        <div class="pt-4 flex justify-end">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-md shadow transition duration-150">
                Guardar Estudiante
            </button>
        </div>
    </form>
</div>
@endsection
