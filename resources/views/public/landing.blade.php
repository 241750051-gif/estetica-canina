@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto space-y-12 py-6">

    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-violet-600 to-indigo-600 text-white rounded-3xl p-8 sm:p-12 text-center shadow-lg">
        <h1 class="text-3xl sm:text-5xl font-extrabold mb-4 tracking-tight">El mejor cuidado para tu mejor amigo</h1>
        <p class="text-violet-100 text-lg max-w-2xl mx-auto mb-8">Servicios profesionales de baño, corte estilizado e higiene canina.</p>
        <div class="flex justify-center gap-4 flex-wrap">
            <a href="#servicios" class="px-6 py-3 bg-white text-violet-700 font-bold rounded-2xl hover:bg-violet-50 transition shadow-md">
                Ver Servicios
            </a>
        </div>
    </div>

    <!-- Servicios Destacados -->
    <div id="servicios" class="space-y-6">
        <div class="text-center">
            <h2 class="text-2xl font-bold text-slate-800">Nuestros Servicios Profesionales</h2>
            <p class="text-slate-500 text-sm">Ofrecemos atenciones adaptadas al tamaño y raza de tu mascota</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($services as $service)
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition flex flex-col justify-between">
                    <div>
                        <h3 class="font-bold text-slate-800 text-lg mb-2">{{ $service->name }}</h3>
                        <p class="text-slate-500 text-sm mb-4">{{ $service->description }}</p>
                    </div>
                    <div class="pt-4 border-t border-slate-100 flex justify-between items-center">
                        <span class="text-violet-700 font-extrabold text-lg">${{ number_format($service->price, 2) }} MXN</span>
                        <span class="text-xs text-slate-400 bg-slate-100 px-2.5 py-1 rounded-full">{{ $service->duration_minutes }} min</span>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center text-slate-400 py-8">
                    No hay servicios registrados actualmente.
                </div>
            @endforelse
        </div>
    </div>

    <!-- Contacto e Información -->
    <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm grid grid-cols-1 md:grid-cols-2 gap-8">
        <div>
            <h3 class="text-xl font-bold text-slate-800 mb-4">Visítanos o Contáctanos</h3>
            <ul class="space-y-3 text-sm text-slate-600">
                <li><strong>Ubicación:</strong> Av. Principal #123, Colonia Centro</li>
                <li><strong>Teléfono:</strong> (555) 100-2000</li>
                <li><strong>Correo:</strong> contacto@esteticacanina.com</li>
            </ul>
        </div>
        <div>
            <h3 class="text-xl font-bold text-slate-800 mb-4">Horarios de Atención</h3>
            <p class="text-sm text-slate-600">Atendemos de <strong>Lunes a Sábado de 09:00 AM a 06:00 PM</strong>. Reserva con anticipación para asegurar el lugar de tu mascota.</p>
        </div>
    </div>

</div>
@endsection