<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autenticacion - Estética Canina</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header class="main-header">
        <a href="{{ route('landing') }}" class="brand-title">ESTETICA CANINA</a>
        <button id="theme-toggle" class="btn btn-secondary" style="padding: 0.4rem 0.8rem;">Modo Oscuro/Claro</button>
    </header>

    <div class="auth-split-container">
        <div class="auth-banner">
            <h1 style="font-size: 2.5rem; margin-bottom: 1rem;">Estética Canina</h1>
            <p style="font-size: 1.1rem; max-width: 400px;">Cuidado profesional y atencion personalizada para la salud e higiene de tus mascotas.</p>
        </div>

        <div class="auth-form-container">
            <div class="auth-card">
                @yield('content')
            </div>
        </div>
    </div>

    <footer class="main-footer">
        <p>&copy; {{ date('Y') }} Estética Canina. Todos los derechos reservados.</p>
    </footer>
</body>
</html>