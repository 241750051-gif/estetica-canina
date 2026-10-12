@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-slate-800">Agendar Nueva Cita</h1>
        <a href="{{ route('cliente.appointments.index') }}" class="px-4 py-2 bg-slate-200 text-slate-700 rounded-xl text-sm font-medium hover:bg-slate-300 transition">
            &larr; Volver
        </a>
    </div>

    @if($errors->any())
        <div class="mb-4 p-4 bg-rose-100 border border-rose-200 text-rose-700 rounded-xl text-sm">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('cliente.appointments.store') }}" method="POST" class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm space-y-5">
        @csrf

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Mascota</label>
            <select name="pet_id" required class="w-full rounded-xl border-slate-200 p-3 text-sm focus:ring-violet-500">
                <option value="">Selecciona una mascota</option>
                @foreach($pets as $pet)
                    <option value="{{ $pet->id }}">{{ $pet->name }} ({{ $pet->species }})</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Servicio</label>
            <select name="service_id" required class="w-full rounded-xl border-slate-200 p-3 text-sm focus:ring-violet-500">
                <option value="">Selecciona un servicio</option>
                @foreach($services as $service)
                    <option value="{{ $service->id }}">{{ $service->name }} - ${{ number_format($service->price, 2) }} MXN</option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Fecha</label>
                <input type="date" name="appointment_date" min="{{ date('Y-m-d') }}" required class="w-full rounded-xl border-slate-200 p-3 text-sm focus:ring-violet-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Hora de Atención</label>
                <select name="appointment_time" required class="w-full rounded-xl border-slate-200 p-3 text-sm focus:ring-violet-500">
                    <option value="">Selecciona horario</option>
                    @foreach($timeSlots as $slot)
                        <option value="{{ $slot }}">{{ $slot }} hrs</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Notas adicionales (Opcional)</label>
            <textarea name="notes" rows="3" class="w-full rounded-xl border-slate-200 p-3 text-sm focus:ring-violet-500" placeholder="Alergias, comportamiento, etc."></textarea>
        </div>

        <div class="flex justify-end gap-3 pt-4">
            <a href="{{ route('cliente.appointments.index') }}" class="px-5 py-2.5 bg-slate-100 text-slate-600 rounded-xl text-sm font-medium hover:bg-slate-200 transition">
                Cancelar
            </a>
            <button type="submit" class="px-5 py-2.5 bg-violet-600 text-white rounded-xl text-sm font-medium hover:bg-violet-700 transition">
                Confirmar Cita
            </button>
        </div>
    </form>
</div>
@endsection