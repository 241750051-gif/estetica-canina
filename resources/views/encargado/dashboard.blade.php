@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 space-y-6">
    
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-[#2D2B2A]">Panel de Control (Encargado)</h1>
            <p class="text-sm text-slate-500">Resumen operativo de la estética canina</p>
        </div>
        <a href="{{ route('encargado.appointments.index') }}" class="px-4 py-2 bg-[#85746E] hover:bg-[#72625C] text-white rounded-xl text-sm font-medium transition shadow-sm">
            Atender Citas
        </a>
    </div>

    <!-- Tarjetas Informativas -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
            <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block mb-1">Citas Hoy</span>
            <span class="text-3xl font-extrabold text-[#22202E]">{{ $todayAppointments }}</span>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
            <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block mb-1">Pendientes</span>
            <span class="text-3xl font-extrabold text-[#85746E]">{{ $pendingAppointments }}</span>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
            <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block mb-1">Total Citas</span>
            <span class="text-3xl font-extrabold text-[#22202E]">{{ $totalAppointments }}</span>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
            <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block mb-1">Servicios Activos</span>
            <span class="text-3xl font-extrabold text-[#22202E]">{{ $servicesCount }}</span>
        </div>
    </div>

    <!-- Sección de accesos rápidos -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4">
        <div class="bg-[#C2C7E5]/30 p-6 rounded-2xl border border-[#A3A8CF]/50">
            <h3 class="text-lg font-bold text-[#2D2B2A] mb-2">Gestión de Horarios</h3>
            <p class="text-sm text-slate-600 mb-4">Activa o desactiva los días de atención de la estética para la recepción de citas.</p>
            <a href="{{ route('encargado.schedules.index') }}" class="inline-block px-4 py-2 bg-[#85746E] hover:bg-[#72625C] text-white text-xs font-medium rounded-xl transition">
                Configurar Horarios
            </a>
        </div>

        <div class="bg-[#C2C7E5]/30 p-6 rounded-2xl border border-[#A3A8CF]/50">
            <h3 class="text-lg font-bold text-[#2D2B2A] mb-2">Catálogo de Servicios</h3>
            <p class="text-sm text-slate-600 mb-4">Administra precios, descripciones y tiempos de duración de los tratamientos.</p>
            <a href="{{ route('encargado.servicios.index') }}" class="inline-block px-4 py-2 bg-[#85746E] hover:bg-[#72625C] text-white text-xs font-medium rounded-xl transition">
                Administrar Servicios
            </a>
        </div>
    </div>

</div>
@endsection