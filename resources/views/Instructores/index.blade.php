@extends('layaout/plantilla')
@section('title', 'Inicio')
@section('header')
    Bienvenidos a mi sitio web
@endsection
@section('content')
<div class="mb-4">
    <a href="{{ route('home') }}" class="bg-cyan-600 hover:bg-cyan-700 text-white px-4 py-2 rounded">
        Volver al inicio
    </a>
</div>
<h1>
    LISTA DE INSTRUCTORES
</h1>

<ul>
    @foreach($instructores as $instructor)
        <li>

            {{ $instructor->nombre }} {{ $instructor->apellido }}
            (Cursos: {{ $instructor->curso_count }})
        </li>
    @endforeach
</ul>

<div class="mt-4">
    {{ $instructores->links() }}
</div>
@endsection

@push('scripts')
    <script>
        console.log("Pagina de inicio cargada")
    </script>
@endpush
