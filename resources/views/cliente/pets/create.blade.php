@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-6 px-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-slate-800">Registrar Mascota</h1>
        <a href="{{ route('cliente.mascotas.index') }}" class="px-4 py-2 bg-slate-200 text-slate-700 rounded-xl text-sm font-medium hover:bg-slate-300">
            &larr; Volver
        </a>
    </div>

    <form action="{{ route('cliente.mascotas.store') }}" method="POST" class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium text-slate-700">Nombre</label>
            <input type="text" name="name" required class="w-full rounded-xl border-slate-200 p-3 text-sm">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-slate-700">Especie</label>
                <select name="species" class="w-full rounded-xl border-slate-200 p-3 text-sm">
                    <option value="Perro">Perro</option>
                    <option value="Gato">Gato</option>
                    <option value="Otro">Otro</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700">Raza</label>
                <input type="text" name="breed" placeholder="Ej. Poodle" class="w-full rounded-xl border-slate-200 p-3 text-sm">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-slate-700">Edad (Años)</label>
                <input type="number" name="years" min="0" max="30" placeholder="0" class="w-full rounded-xl border-slate-200 p-3 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700">Edad (Meses)</label>
                <input type="number" name="months" min="0" max="11" placeholder="0" class="w-full rounded-xl border-slate-200 p-3 text-sm">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700">Observaciones</label>
            <textarea name="notes" rows="3" class="w-full rounded-xl border-slate-200 p-3 text-sm"></textarea>
        </div>

        <div class="flex justify-end gap-3 pt-2">
            <button type="submit" class="px-5 py-2.5 bg-violet-600 text-white rounded-xl text-sm font-medium hover:bg-violet-700">
                Guardar Mascota
            </button>
        </div>
    </form>
</div>
@endsection