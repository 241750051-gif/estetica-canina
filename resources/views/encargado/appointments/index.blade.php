@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-[#2D2B2A]">Gestión de Citas Solicitadas</h1>
            <p class="text-sm text-slate-500">Revisión y cambio de estado de solicitudes de clientes</p>
        </div>
        <a href="{{ route('encargado.dashboard') }}" class="px-4 py-2 bg-slate-200 text-slate-700 rounded-xl text-sm font-medium hover:bg-slate-300 transition">
            &larr; Volver
        </a>
    </div>

    @if(session('success'))
        <div class="p-4 bg-emerald-100 border border-emerald-300 text-emerald-800 rounded-xl text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 text-slate-600 text-xs uppercase font-semibold border-b border-slate-200">
                    <th class="p-4">Cliente</th>
                    <th class="p-4">Mascota</th>
                    <th class="p-4">Fecha / Hora</th>
                    <th class="p-4">Servicios</th>
                    <th class="p-4">Estado</th>
                    <th class="p-4 text-right">Actualizar Estado</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm">
                @forelse($appointments as $app)
                    <tr class="hover:bg-slate-50">
                        <td class="p-4">
                            <span class="font-semibold text-[#2D2B2A] block">{{ $app->user->name ?? 'N/A' }}</span>
                            <span class="text-xs text-slate-500">{{ $app->user->email ?? '' }}</span>
                        </td>
                        <td class="p-4 font-medium text-slate-700">
                            {{ $app->pet->name ?? 'N/A' }}
                        </td>
                        <td class="p-4 text-slate-600">
                            {{ $app->appointment_date }} / {{ $app->appointment_time }}
                        </td>
                        <td class="p-4 text-slate-600">
                            @foreach($app->services as $service)
                                <span class="inline-block bg-[#C2C7E5]/30 text-[#22202E] text-xs px-2 py-0.5 rounded-md mb-1 font-medium">
                                    {{ $service->name }}
                                </span>
                            @endforeach
                        </td>
                        <td class="p-4">
                            <span class="px-2.5 py-1 rounded-full text-xs font-semibold
                                @if($app->status === 'Confirmada') bg-emerald-100 text-emerald-800
                                @elseif($app->status === 'Pendiente') bg-amber-100 text-amber-800
                                @elseif($app->status === 'Completada') bg-blue-100 text-blue-800
                                @elseif($app->status === 'Cancelada') bg-rose-100 text-rose-800
                                @else bg-slate-100 text-slate-700 @endif">
                                {{ $app->status }}
                            </span>
                        </td>
                        <td class="p-4 text-right">
                            <form action="{{ route('encargado.appointments.update', $app->id) }}" method="POST" class="inline-flex gap-2 justify-end">
                                @csrf
                                @method('PUT')
                                <select name="status" class="text-xs border-slate-200 rounded-lg p-1.5 focus:ring-[#85746E]">
                                    <option value="Pendiente" {{ $app->status == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                                    <option value="Confirmada" {{ $app->status == 'Confirmada' ? 'selected' : '' }}>Confirmada</option>
                                    <option value="Completada" {{ $app->status == 'Completada' ? 'selected' : '' }}>Completada</option>
                                    <option value="Cancelada" {{ $app->status == 'Cancelada' ? 'selected' : '' }}>Cancelada</option>
                                </select>
                                <button type="submit" class="px-3 py-1.5 bg-[#85746E] hover:bg-[#72625C] text-white rounded-lg text-xs font-medium transition">
                                    Guardar
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-8 text-center text-slate-400">No hay citas registradas en la plataforma.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection