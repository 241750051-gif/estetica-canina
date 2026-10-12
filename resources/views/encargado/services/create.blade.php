@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-6 px-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-[#2D2B2A]">Nuevo Servicio</h1>
        <a href="{{ route('encargado.servicios.index') }}" class="px-4 py-2 bg-slate-200 text-slate-700 rounded-xl text-sm font-medium hover:bg-slate-300">
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

    <form action="{{ route('encargado.servicios.store') }}" method="POST" class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Nombre del Servicio</label>
            <input type="text" name="name" required class="w-full rounded-xl border-slate-200 p-3 text-sm focus:ring-[#85746E]">
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Descripción</label>
            <textarea name="description" rows="3" required class="w-full rounded-xl border-slate-200 p-3 text-sm focus:ring-[#85746E]"></textarea>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Precio ($ MXN)</label>
                <input type="number" step="0.01" min="0.01" name="price" required placeholder="0.00" class="w-full rounded-xl border-slate-200 p-3 text-sm focus:ring-[#85746E]">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Duración (Minutos)</label>
                <input type="number" min="15" step="5" name="duration_minutes" required placeholder="30" class="w-full rounded-xl border-slate-200 p-3 text-sm focus:ring-[#85746E]">
            </div>
        </div>

        <div class="flex justify-end gap-3 pt-3">
            <a href="{{ route('encargado.servicios.index') }}" class="px-4 py-2.5 bg-slate-100 text-slate-600 rounded-xl text-sm font-medium hover:bg-slate-200">
                Cancelar
            </a>
            <button type="submit" class="px-5 py-2.5 bg-[#85746E] hover:bg-[#72625C] text-white rounded-xl text-sm font-medium transition shadow-sm">
                Guardar Servicio
            </button>
        </div>
    </form>
</div>
@endsection