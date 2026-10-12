<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estética Canina</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Roboto', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased min-h-screen flex flex-col">

    <!-- Header -->
    <header class="bg-white border-b border-slate-200 sticky top-0 z-30 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center gap-4">
                @auth
                <button id="sidebar-toggle" class="p-2 rounded-xl text-slate-600 hover:bg-slate-100 transition focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                @endauth
                <a href="{{ route('landing') }}" class="text-xl font-bold text-violet-700 tracking-tight">
                    ESTÉTICA CANINA
                </a>
            </div>

            <div class="flex items-center gap-4">
                @auth
                    <span class="text-sm font-medium text-slate-600 hidden sm:inline">
                        {{ Auth::user()->name }} 
                        <span class="text-xs bg-violet-100 text-violet-700 px-2 py-0.5 rounded-full uppercase ml-1 font-semibold">
                            {{ Auth::user()->role }}
                        </span>
                    </span>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-xs bg-slate-100 hover:bg-slate-200 text-slate-700 px-3 py-2 rounded-xl transition font-medium">
                            Cerrar Sesión
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium text-slate-600 hover:text-slate-900 px-3 py-2">Iniciar Sesión</a>
                    <a href="{{ route('register') }}" class="text-sm font-medium bg-violet-600 text-white px-4 py-2 rounded-xl hover:bg-violet-700 transition shadow-sm">Registrarse</a>
                @endauth
            </div>
        </div>
    </header>

    <div class="flex flex-1 relative">
        @auth
        <!-- Menú Lateral -->
        <aside id="sidebar" class="w-64 bg-white border-r border-slate-200 p-4 absolute md:relative z-20 h-full transition-transform duration-300 transform -translate-x-full md:translate-x-0 shadow-lg md:shadow-none">
            <nav class="space-y-1">
                @if(Auth::user()->isCliente())
                    <a href="{{ route('cliente.dashboard') }}" class="block px-4 py-3 text-sm font-medium rounded-xl text-slate-700 hover:bg-violet-50 hover:text-violet-700 transition">
                        Dashboard
                    </a>
                    <a href="{{ route('cliente.mascotas.index') }}" class="block px-4 py-3 text-sm font-medium rounded-xl text-slate-700 hover:bg-violet-50 hover:text-violet-700 transition">
                        Mis Mascotas
                    </a>
                    <a href="{{ route('cliente.appointments.index') }}" class="block px-4 py-3 text-sm font-medium rounded-xl text-slate-700 hover:bg-violet-50 hover:text-violet-700 transition">
                        Mis Citas
                    </a>
                @elseif(Auth::user()->isEncargado())
                    <a href="{{ route('encargado.dashboard') }}" class="block px-4 py-3 text-sm font-medium rounded-xl text-slate-700 hover:bg-violet-50 hover:text-violet-700 transition">
                        Dashboard
                    </a>
                    <a href="{{ route('encargado.appointments.index') }}" class="block px-4 py-3 text-sm font-medium rounded-xl text-slate-700 hover:bg-violet-50 hover:text-violet-700 transition">
                        Gestión Citas
                    </a>
                    <a href="{{ route('encargado.servicios.index') }}" class="block px-4 py-3 text-sm font-medium rounded-xl text-slate-700 hover:bg-violet-50 hover:text-violet-700 transition">
                        Servicios
                    </a>
                    <a href="{{ route('encargado.schedules.index') }}" class="block px-4 py-3 text-sm font-medium rounded-xl text-slate-700 hover:bg-violet-50 hover:text-violet-700 transition">
                        Horarios
                    </a>
                @endif
            </nav>
        </aside>
        @endauth

        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>

    <footer class="bg-white border-t border-slate-200 py-4 text-center text-xs text-slate-500">
        &copy; {{ date('Y') }} Estética Canina. Todos los derechos reservados.
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleBtn = document.getElementById('sidebar-toggle');
            const sidebar = document.getElementById('sidebar');

            if (toggleBtn && sidebar) {
                toggleBtn.addEventListener('click', function () {
                    sidebar.classList.toggle('-translate-x-full');
                });
            }
        });
    </script>
</body>
</html>