@extends('layaout/plantilla')

@section('title', 'Registro de Usuario')

@section('header')
    Crear una Cuenta Nueva
@endsection

@section('content')
<div class="container mx-auto px-4 py-6 max-w-md">

    <form action="{{ route('register.store') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf

        <!-- Mostrar errores generales de validación -->
        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                Nombre Completo:
            </label>
            <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror"
                id="name"
                type="text"
                name="name"
                value="{{ old('name') }}"
                required
                autofocus
            >
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                Correo Electrónico:
            </label>
            <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror"
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
            >
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                Contraseña:
            </label>
            <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline @error('password') border-red-500 @enderror"
                id="password"
                type="password"
                name="password"
                required
            >
        </div>

        <div class="mb-6 flex items-center justify-between">
            <a href="{{ route('login') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                ¿Ya tienes una cuenta? Inicia sesión
            </a>
        </div>

        <div class="flex items-center justify-between">
            <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                Registrarse
            </button>
        </div>

        <div class="mt-6 text-center">
            <a href="{{ route('home') }}" class="inline-block font-bold text-sm text-blue-500 hover:text-blue-800">
                Volver al inicio
            </a>
        </div>
    </form>
</div>
@endsection
