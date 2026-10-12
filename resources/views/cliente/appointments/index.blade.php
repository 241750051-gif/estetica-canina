@extends('layouts.app')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
    <h2>Mis Citas y Solicitudes</h2>
    <a href="{{ route('cliente.appointments.create') }}" class="btn btn-primary">Solicitar Cita</a>
</div>

<div class="table-responsive">
    <table class="custom-table">
        <thead>
            <tr>
                <th>Mascota</th>
                <th>Servicios</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($appointments as $app)
            <tr>
                <td>{{ $app->pet->name }}</td>
                <td>
                    @foreach($app->services as $s)
                        <small>- {{ $s->name }}</small><br>
                    @endforeach
                </td>
                <td>{{ $app->appointment_date }}</td>
                <td>{{ $app->appointment_time }}</td>
                <td><span class="badge badge-{{ $app->status }}">{{ ucfirst($app->status) }}</span></td>
                <td>
                    @if($app->status === 'pendiente')
                    <form action="{{ route('cliente.appointments.cancel', $app) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" style="padding: 0.3rem 0.6rem;">Cancelar</button>
                    </form>
                    @else
                    <span>N/A</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6">No tienes historial de citas.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection