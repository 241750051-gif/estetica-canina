@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Horarios de Atención</h1>
                <p class="text-sm text-slate-500">Gestión de días laborales y franjas horarias de la estética</p>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 bg-emerald-100 border border-emerald-300 text-emerald-800 rounded-xl text-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100 text-slate-600 text-xs font-semibold uppercase tracking-wider">
                        <th class="py-4 px-6">Día de la semana</th>
                        <th class="py-4 px-6">Hora de Apertura</th>
                        <th class="py-4 px-6">Hora de Cierre</th>
                        <th class="py-4 px-6">Estado</th>
                        <th class="py-4 px-6 text-right">Acción</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                    @forelse($schedules as $schedule)
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="py-4 px-6 font-medium text-slate-900">
                                {{ $schedule->day_of_week }}
                            </td>
                            <td class="py-4 px-6">
                                {{ \Carbon\Carbon::parse($schedule->start_time)->format('h:i A') }}
                            </td>
                            <td class="py-4 px-6">
                                {{ \Carbon\Carbon::parse($schedule->end_time)->format('h:i A') }}
                            </td>
                            <td class="py-4 px-6">
                                @if($schedule->is_active)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                        Activo
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-600">
                                        Inactivo
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-right">
                                <form action="{{ route('encargado.schedules.update', $schedule->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="is_active" value="{{ $schedule->is_active ? 0 : 1 }}">
                                    <button type="submit" class="text-xs px-3 py-1.5 rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-100 transition font-medium">
                                        {{ $schedule->is_active ? 'Desactivar' : 'Activar' }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-slate-400">
                                No hay horarios configurados en el sistema.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection