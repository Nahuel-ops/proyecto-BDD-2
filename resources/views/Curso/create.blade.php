@extends('layaout/plantilla')

@section('title', 'Nuevo Curso')

@section('header')
    Crear Nuevo Curso
@endsection

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-md border border-gray-200">

        <form action="{{ route('curso.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- Nombre del Curso --}}
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre del Curso</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old('name') }}"
                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Ej. Programación en Laravel"
                >
                @error('name')
                    <p class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</p>
                @enderror
            </div>

            {{-- Categoría --}}
            <div>
                <label for="categoria_id" class="block text-sm font-medium text-gray-700 mb-1">Categoría</label>
                <select
                    name="categoria_id"
                    id="categoria_id"
                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                    <option value="">Seleccione una categoría...</option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                            {{ $categoria->name }}
                        </option>
                    @endforeach
                </select>
                @error('categoria_id')
                    <p class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</p>
                @enderror
            </div>

            {{-- Descripción --}}
            <div>
                <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                <textarea
                    name="descripcion"
                    id="descripcion"
                    rows="4"
                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Escribe una breve descripción del curso..."
                >{{ old('descripcion') }}</textarea>
                @error('descripcion')
                    <p class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</p>
                @enderror
            </div>

            {{-- Subida de Imagen y Vista Previa --}}
            <div class="border border-gray-200 rounded-md p-4 bg-gray-50">
                <label for="imagen" class="block text-sm font-bold text-gray-700 mb-2">Imagen del Curso (Opcional)</label>

                <input
                    type="file"
                    name="imagen"
                    id="imagen"
                    accept="image/*"
                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700 bg-white border border-gray-300 rounded-md p-1 cursor-pointer transition"
                >
                @error('imagen')
                    <p class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</p>
                @enderror

                {{-- Contenedor de la Vista Previa --}}
                <div class="mt-5">
                    <p class="text-xs font-semibold text-gray-500 uppercase mb-2 tracking-wider">Vista Previa:</p>
                    <div class="w-full sm:w-80 h-48 border-2 border-dashed border-gray-300 rounded-lg overflow-hidden flex items-center justify-center bg-white shadow-inner">
                        <img
                            id="preview"
                            src="{{ asset('storage/img/curso-default.png') }}"
                            alt="Vista previa de la imagen"
                            class="w-full h-full object-cover"
                        >
                    </div>
                </div>
            </div>

            {{-- Botones de Acción --}}
            <div class="flex items-center justify-end gap-4 pt-4">
                <a href="{{ route('curso.index') }}" class="px-6 py-2 text-gray-600 font-semibold hover:text-gray-900 transition">
                    Cancelar
                </a>
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-6 rounded-md shadow-md transition duration-200">
                    Guardar Curso
                </button>
            </div>

        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Script para mostrar la vista previa de la imagen seleccionada
    document.getElementById('imagen').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('preview');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        } else {
            // Si el usuario cancela la ventana de archivos, regresa a la imagen por defecto
            preview.src = "{{ asset('storage/img/curso-default.png') }}";
        }
    });
</script>
@endpush
