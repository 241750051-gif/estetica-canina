@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Mis Mascotas</h1>
            <p class="text-sm text-slate-500">Maneja el perfil de tus animales de compañía</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('cliente.dashboard') }}" class="px-4 py-2 bg-slate-200 text-slate-700 rounded-xl text-sm font-medium hover:bg-slate-300">
                &larr; Volver
            </a>
            <a href="{{ route('cliente.mascotas.create') }}" class="px-4 py-2 bg-violet-600 text-white rounded-xl text-sm font-medium hover:bg-violet-700">
                + Registrar Mascota
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-emerald-100 border border-emerald-300 text-emerald-800 rounded-xl text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden shadow-sm">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 text-slate-600 text-xs uppercase font-semibold border-b border-slate-100">
                    <th class="p-4">Nombre</th>
                    <th class="p-4">Especie</th>
                    <th class="p-4">Raza</th>
                    <th class="p-4">Edad</th>
                    <th class="p-4">Notas</th>
                    <th class="p-4 text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm">
                @forelse($pets as $pet)
                    <tr class="hover:bg-slate-50">
                        <td class="p-4 font-semibold text-slate-800">{{ $pet->name }}</td>
                        <td class="p-4">{{ $pet->species }}</td>
                        <td class="p-4">{{ $pet->breed }}</td>
                        <td class="p-4">{{ $pet->age }}</td>
                        <td class="p-4 text-slate-500">{{ $pet->notes ?: 'Sin notas' }}</td>
                        <td class="p-4 text-right flex justify-end gap-2">
                            <a href="{{ route('cliente.mascotas.edit', $pet->id) }}" class="px-3 py-1.5 bg-amber-100 text-amber-700 rounded-lg text-xs font-medium hover:bg-amber-200">
                                Editar
                            </a>
                            <form action="{{ route('cliente.mascotas.destroy', $pet->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar esta mascota?');">
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
                        <td colspan="6" class="p-8 text-center text-slate-400">No tienes mascotas registradas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection