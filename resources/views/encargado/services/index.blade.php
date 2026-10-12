@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-[#2D2B2A]">Catálogo de Servicios</h1>
            <p class="text-sm text-slate-500">Gestión de precios, tratamientos y tiempos de atención</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('encargado.dashboard') }}" class="px-4 py-2 bg-slate-200 text-slate-700 rounded-xl text-sm font-medium hover:bg-slate-300 transition">
                &larr; Volver
            </a>
            <a href="{{ route('encargado.servicios.create') }}" class="px-4 py-2 bg-[#85746E] hover:bg-[#72625C] text-white rounded-xl text-sm font-medium transition shadow-sm">
                + Nuevo Servicio
            </a>
        </div>
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
                    <th class="p-4">Servicio</th>
                    <th class="p-4">Descripción</th>
                    <th class="p-4">Precio</th>
                    <th class="p-4">Duración</th>
                    <th class="p-4 text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm">
                @forelse($services as $service)
                    <tr class="hover:bg-slate-50">
                        <td class="p-4 font-semibold text-[#2D2B2A]">{{ $service->name }}</td>
                        <td class="p-4 text-slate-500 max-w-xs">{{ $service->description }}</td>
                        <td class="p-4 font-bold text-[#85746E]">${{ number_format($service->price, 2) }} MXN</td>
                        <td class="p-4 text-slate-600">{{ $service->duration_minutes }} min</td>
                        <td class="p-4 text-right flex justify-end gap-2">
                            <a href="{{ route('encargado.servicios.edit', $service->id) }}" class="px-3 py-1.5 bg-[#C2C7E5]/50 text-[#22202E] rounded-lg text-xs font-medium hover:bg-[#C2C7E5]">
                                Editar
                            </a>
                            <form action="{{ route('encargado.servicios.destroy', $service->id) }}" method="POST" onsubmit="return confirm('¿Deseas eliminar este servicio?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1.5 bg-rose-100 text-rose-700 rounded-lg text-xs font-medium hover:bg-rose-200">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-slate-400">No hay servicios registrados en la base de datos.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection