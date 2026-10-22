@extends('layaout/plantilla')

@section('title', 'Inicio')

@section('header')
    Bienvenidos a mi sitio web
@endsection

@section('content')
<div class="container mx-auto px-4 py-6">

    <div class="flex flex-wrap justify-between items-center mb-6 gap-4 bg-gray-50 p-4 rounded shadow-sm">
        <div class="flex flex-wrap gap-2 items-center">
            <a href="{{ route('home') }}" class="bg-cyan-600 hover:bg-cyan-700 text-white font-semibold px-4 py-2 rounded shadow">
                Inicio
            </a>
            <a href="{{ route('curso.index') }}" class="bg-blue-600 text-white font-semibold px-4 py-2 rounded shadow">
                Cursos
            </a>
            <a href="{{ route('categorias.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-semibold px-4 py-2 rounded shadow">
                Gestionar Categorías
            </a>
            <a href="{{ route('turnos.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-semibold px-4 py-2 rounded shadow">
                Gestionar Turnos
            </a>
        </div>

        <div class="flex items-center gap-4">
            <a href="{{ route('curso.create') }}" class="bg-green-500 hover:bg-green-600 text-white font-bold px-4 py-2 rounded shadow">
                + Nuevo Curso
            </a>

            @auth
                <div class="flex items-center gap-2">
                    <span class="text-sm font-semibold text-gray-700 hidden md:inline">Hola, {{ Auth::user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold px-3 py-2 rounded shadow text-sm">
                            Cerrar Sesión
                        </button>
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-4 py-2 rounded shadow text-sm">
                    Iniciar Sesión
                </a>
            @endauth
        </div>
    </div>

    <form method="GET" action="{{ route('curso.index') }}" class="mb-6 flex flex-wrap gap-4 items-center">
        <input
            type="text"
            name="buscar"
            placeholder="Buscar por nombre..."
            value="{{ request('buscar') }}"
            class="border rounded px-4 py-2 w-1/3"
        >

        <select name="categoria_id" class="border rounded px-4 py-2">
            <option value="">Todas las categorías</option>
            @foreach($categorias as $categoria)
                <option value="{{ $categoria->id }}" {{ request('categoria_id') == $categoria->id ? 'selected' : '' }}>
                    {{ $categoria->name }}
                </option>
            @endforeach
        </select>

        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
            Filtrar
        </button>

        <a href="{{ route('curso.index') }}" class="bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded flex items-center">
            Limpiar
        </a>
    </form>

    <div class="overflow-x-auto bg-white shadow-md rounded">
        <table class="min-w-full border-collapse">
            <thead>
                <tr class="bg-gray-200 text-left text-gray-700">
                    <th class="py-3 px-4 border-b">ID</th>
                    <th class="py-3 px-4 border-b">Imagen</th> {{-- Añadido el encabezado para la imagen --}}
                    <th class="py-3 px-4 border-b">Nombre</th>
                    <th class="py-3 px-4 border-b">Categoría</th>
                    <th class="py-3 px-4 border-b">Instructor</th>
                    <th class="py-3 px-4 border-b">Descripción</th>
                    <th class="py-3 px-4 border-b">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($cursos as $curso)
                    <tr class="hover:bg-gray-50">
                        <td class="py-3 px-4 border-b">{{ $curso->id }}</td>

                        {{-- Columna de la Imagen corregida --}}
                        <td class="py-3 px-4 border-b">
                            <img
                                src="{{ $curso->imagen_url ?? asset($curso->imagen ?? 'img/curso-default.png') }}"
                                alt="{{ $curso->name }}"
                                class="object-cover rounded shadow-sm"
                                style="max-width: 80px; height: 60px;"
                                onerror="this.src='{{ asset('img/curso-default.png') }}';"
                            >
                        </td>

                        <td class="py-3 px-4 border-b font-semibold">{{ $curso->nombre ?? $curso->name }}</td>

                        <td class="py-3 px-4 border-b">
                            {{ $curso->categoria ? $curso->categoria->name : 'Sin categoría' }}
                        </td>

                        <td class="py-3 px-4 border-b">
                            {{ $curso->instructor ? $curso->instructor->nombre . ' ' . $curso->instructor->apellido : 'Sin asignar' }}
                        </td>

                        <td class="py-3 px-4 border-b text-gray-600">{{ Str::limit($curso->descripcion, 40) }}</td>

                        <td class="py-3 px-4 border-b">
                            <a href="{{ route('curso.show', $curso->id) }}" class="text-blue-600 hover:underline">Ver</a>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-4 text-center text-gray-500"> {{-- Cambiado a colspan="7" --}}
                            No se encontraron cursos registrados.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $cursos->links() }}
    </div>

</div>
@endsection

@push('scripts')
    <script>
        console.log("Pagina de inicio cargada")
    </script>
@endpush
