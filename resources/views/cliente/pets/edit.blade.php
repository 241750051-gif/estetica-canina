@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-6 px-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-slate-800">Editar Mascota</h1>
        <a href="{{ route('cliente.mascotas.index') }}" class="px-4 py-2 bg-slate-200 text-slate-700 rounded-xl text-sm font-medium hover:bg-slate-300">
            &larr; Volver
        </a>
    </div>

    @if($errors->any())
        <div class="mb-4 p-4 bg-rose-100 text-rose-700 rounded-xl text-sm">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('cliente.mascotas.update', $mascota->id) }}" method="POST" class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Nombre</label>
            <input type="text" name="name" value="{{ old('name', $mascota->name) }}" required class="w-full rounded-xl border-slate-200 p-3 text-sm">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Especie</label>
                <select name="species" class="w-full rounded-xl border-slate-200 p-3 text-sm">
                    <option value="Perro" {{ $mascota->species == 'Perro' ? 'selected' : '' }}>Perro</option>
                    <option value="Gato" {{ $mascota->species == 'Gato' ? 'selected' : '' }}>Gato</option>
                    <option value="Otro" {{ $mascota->species == 'Otro' ? 'selected' : '' }}>Otro</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Raza</label>
                <input type="text" name="breed" value="{{ old('breed', $mascota->breed) }}" class="w-full rounded-xl border-slate-200 p-3 text-sm">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Edad (Texto libre: ej. 2 años, 5 meses)</label>
            <input type="text" name="age" value="{{ old('age', $mascota->age) }}" class="w-full rounded-xl border-slate-200 p-3 text-sm">
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Observaciones</label>
            <textarea name="notes" rows="3" class="w-full rounded-xl border-slate-200 p-3 text-sm">{{ old('notes', $mascota->notes) }}</textarea>
        </div>

        <div class="flex justify-end gap-3 pt-2">
            <a href="{{ route('cliente.mascotas.index') }}" class="px-4 py-2 bg-slate-100 text-slate-600 rounded-xl text-sm font-medium hover:bg-slate-200">
                Cancelar
            </a>
            <button type="submit" class="px-5 py-2.5 bg-violet-600 text-white rounded-xl text-sm font-medium hover:bg-violet-700">
                Guardar Cambios
            </button>
        </div>
    </form>
</div>
@endsection