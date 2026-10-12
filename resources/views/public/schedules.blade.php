@extends('layouts.app')

@section('content')
<h2>Horarios de Atención</h2>
<div class="table-responsive">
    <table class="custom-table">
        <thead>
            <tr>
                <th>Día</th>
                <th>Hora Apertura</th>
                <th>Hora Cierre</th>
            </tr>
        </thead>
        <tbody>
            @foreach($schedules as $s)
            <tr>
                <td>{{ $s->day_of_week }}</td>
                <td>{{ $s->start_time }}</td>
                <td>{{ $s->end_time }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection