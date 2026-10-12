<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('encargado.services.index', compact('services'));
    }

    public function create()
    {
        return view('encargado.services.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0.01',
            'duration_minutes' => 'required|integer|min:15',
        ], [
            'price.min' => 'El precio debe ser un número positivo mayor a 0.',
            'duration_minutes.min' => 'La duración mínima debe ser de al menos 15 minutos.'
        ]);

        Service::create($validated);

        return redirect()->route('encargado.servicios.index')->with('success', 'Servicio creado correctamente.');
    }

    public function edit(Service $servicio)
    {
        return view('encargado.services.edit', compact('servicio'));
    }

    public function update(Request $request, Service $servicio)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0.01',
            'duration_minutes' => 'required|integer|min:15',
        ], [
            'price.min' => 'El precio no puede ser negativo ni cero.',
            'duration_minutes.min' => 'La duración debe ser un número positivo.'
        ]);

        $servicio->update($validated);

        return redirect()->route('encargado.servicios.index')->with('success', 'Servicio actualizado.');
    }

    public function destroy(Service $servicio)
    {
        $servicio->delete();
        return redirect()->route('encargado.servicios.index')->with('success', 'Servicio eliminado.');
    }
}