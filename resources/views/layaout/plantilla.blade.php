<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Sitio Web</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @stack('styles')
</head>
<body class="bg-white text-gray-800 min-h-screen flex flex-col">
    <header class="bg-gradient-to-r from-cyan-300 via-blue-600 to-black shadow-[0_0_30px_rgba(59,130,246,0.8)]">
        <div class="max-w-7xl mx-auto p-4 flex items-center justify-between gap-4">
            <a href="{{ route('home') }}" class="text-xl font-bold text-white drop-shadow-[0_0_8px_rgba(96,165,250,1)] hover:text-cyan-100">
                @yield('header','Encabezado del sitio')
            </a>
            <a href="{{ route('home') }}" class="text-white font-semibold px-4 py-2 rounded border border-white/70 hover:bg-white/15">
                Volver al inicio
            </a>
        </div>
    </header>
        <main class="grow container mx-auto p-4 bg-white">
            @yield('content')
        </main>
        <footer class="bg-gradient-to-r from-black via-blue-950 to-cyan-400 text-white text-center p-4 shadow-[0_0_25px_rgba(34,211,238,0.7)]">
            <p>&copy; {{ date('Y') }} My Sitio Web. Todos los derechos reservados.</p>
        </footer>
    @stack('scripts')
</body>
</html>
