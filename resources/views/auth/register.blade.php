@extends('layouts.auth')

@section('content')
<h2 style="margin-bottom: 1.5rem; text-align: center;">Registro de Cliente</h2>

<form action="{{ route('register.post') }}" method="POST">
    @csrf
    <div class="form-group">
        <label class="form-label">Nombre Completo</label>
        <input type="text" name="name" class="form-input" value="{{ old('name') }}" required>
    </div>

    <div class="form-group">
        <label class="form-label">Correo Electrónico</label>
        <input type="email" name="email" class="form-input" value="{{ old('email') }}" required>
    </div>

    <div class="form-group">
        <label class="form-label">Teléfono</label>
        <input type="text" name="phone" class="form-input" value="{{ old('phone') }}" required>
    </div>

    <div class="form-group">
        <label class="form-label">Contraseña</label>
        <input type="password" name="password" class="form-input" required>
    </div>

    <div class="form-group">
        <label class="form-label">Confirmar Contraseña</label>
        <input type="password" name="password_confirmation" class="form-input" required>
    </div>

    <button type="submit" class="btn btn-primary" style="width: 100%;">Registrarse</button>
</form>
@endsection