@extends('layouts.auth')

@section('content')
<h2 style="margin-bottom: 1.5rem; text-align: center;">Inicio de Sesión</h2>

<form action="{{ route('login.post') }}" method="POST">
    @csrf
    <div class="form-group">
        <label class="form-label">Correo Electrónico</label>
        <input type="email" name="email" class="form-input" value="{{ old('email') }}" required>
        @error('email')<span style="color:red; font-size: 0.8rem;">{{ $message }}</span>@enderror
    </div>

    <div class="form-group">
        <label class="form-label">Contraseña</label>
        <input type="password" name="password" class="form-input" required>
    </div>

    <button type="submit" class="btn btn-primary" style="width: 100%;">Ingresar</button>
</form>

<p style="margin-top: 1.5rem; text-align: center; font-size: 0.9rem;">
    ¿No tienes cuenta? <a href="{{ route('register') }}" style="color: var(--accent-color);">Regístrate aquí</a>
</p>
@endsection