@extends('layouts.app')

@section('content')
<h2>Editar Servicio: {{ $service->name }}</h2>

<form action="{{ route('encargado.services.update', $service) }}" method="POST" style="margin-top: 1.5rem;">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label class="form-label">Nombre del Servicio</label>
        <input type="text" name="name" class="form-input" value="{{ $service->name }}" required>
    </div>

    <div class="form-group">
        <label class="form-label">Descripción</label>
        <textarea name="description" class="form-textarea" rows="3" required>{{ $service->description }}</textarea>
    </div>

    <div class="form-group">
        <label class="form-label">Precio ($ MXN)</label>
        <input type="number" step="0.01" name="price" class="form-input" value="{{ $service->price }}" required>
    </div>

    <div class="form-group">
        <label class="form-label">Duración (minutos)</label>
        <input type="number" name="duration_minutes" class="form-input" value="{{ $service->duration_minutes }}" required>
    </div>

    <div class="form-group">
        <input type="checkbox" name="is_active" id="is_active" {{ $service->is_active ? 'checked' : '' }}>
        <label for="is_active">Servicio Activo</label>
    </div>

    <button type="submit" class="btn btn-primary">Actualizar Servicio</button>
</form>
@endsection