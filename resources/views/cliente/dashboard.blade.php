@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 space-y-6">

    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-[#2D2B2A]">Panel del Cliente</h1>
            <p class="text-sm text-slate-500">Bienvenido(a), {{ Auth::user()->name }}</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('cliente.mascotas.create') }}" class="px-4 py-2 bg-slate-200 text-slate-700 rounded-xl text-sm font-medium hover:bg-slate-300 transition">
                + Registrar Mascota
            </a>
            <a href="{{ route('cliente.appointments.create') }}" class="px-4 py-2 bg-[#85746E] hover:bg-[#72625C] text-white rounded-xl text-sm font-medium transition shadow-sm">
                Agendar Cita
            </a>
        </div>
    </div>

    <!-- Tarjetas Informativas -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
            <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block mb-1">Mascotas Registradas</span>
            <span class="text-3xl font-extrabold text-[#22202E]">{{ $petsCount }}</span>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
            <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block mb-1">Total de Citas</span>
            <span class="text-3xl font-extrabold text-[#85746E]">{{ $appointmentsCount }}</span>
        </div>
    </div>

    <!-- Mis Mascotas -->
    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm p-6 space-y-4">
        <h2 class="text-lg font-bold text-[#2D2B2A]">Mis Mascotas</h2>
        
        @if($pets->isEmpty())
            <p class="text-sm text-slate-400 py-4">Aún no has registrado ninguna mascota en tu cuenta.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                @foreach($pets as $pet)
                    <div class="bg-[#C2C7E5]/20 p-4 rounded-xl border border-[#A3A8CF]/40">
                        <h3 class="font-bold text-[#2D2B2A]">{{ $pet->name }}</h3>
                        <p class="text-xs text-slate-600">{{ $pet->species }} - {{ $pet->breed ?? 'N/A' }}</p>
                        <p class="text-xs text-slate-500 mt-1">Edad: {{ $pet->age ?? 'No especificada' }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Citas Recientes -->
    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm p-6 space-y-4">
        <div class="flex justify-between items-center">
            <h2 class="text-lg font-bold text-[#2D2B2A]">Últimas Solicitudes de Citas</h2>
            <a href="{{ route('cliente.appointments.index') }}" class="text-xs text-[#85746E] font-semibold hover:underline">
                Ver todas &rarr;
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 text-slate-600 text-xs uppercase font-semibold border-b border-slate-200">
                        <th class="p-3">Mascota</th>
                        <th class="p-3">Fecha</th>
                        <th class="p-3">Hora</th>
                        <th class="p-3">Estado</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($appointments as $appointment)
                        <tr class="hover:bg-slate-50">
                            <td class="p-3 font-semibold text-[#2D2B2A]">{{ $appointment->pet->name ?? 'N/A' }}</td>
                            <td class="p-3 text-slate-600">{{ $appointment->appointment_date }}</td>
                            <td class="p-3 text-slate-600">{{ $appointment->appointment_time }}</td>
                            <td class="p-3">
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold
                                    @if($appointment->status === 'Confirmada') bg-emerald-100 text-emerald-800
                                    @elseif($appointment->status === 'Pendiente') bg-amber-100 text-amber-800
                                    @elseif($appointment->status === 'Cancelada') bg-rose-100 text-rose-800
                                    @else bg-slate-100 text-slate-700 @endif">
                                    {{ $appointment->status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-6 text-center text-slate-400">No registras citas recientes.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection