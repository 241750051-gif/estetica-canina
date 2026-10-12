@extends('layouts.app')

@section('content')
<h2>Catálogo Completo de Servicios</h2>
<div class="bento-grid">
    @foreach($services as $service)
    <div class="bento-card">
        <h3>{{ $service->name }}</h3>
        <p style="margin: 0.5rem 0;">{{ $service->description }}</p>
        <p>Duración estimada: {{ $service->duration_minutes }} minutos</p>
        <p style="font-weight: bold; margin-top: 0.5rem;">${{ number_format($service->price, 2) }} MXN</p>
    </div>
    @endforeach
</div>
@endsection