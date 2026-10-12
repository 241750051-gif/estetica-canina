<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetController extends Controller
{
    public function index()
    {
        $pets = Auth::user()->pets;
        return view('cliente.pets.index', compact('pets'));
    }

    public function create()
    {
        return view('cliente.pets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'species' => 'required|string',
            'breed' => 'nullable|string|max:100',
            'years' => 'nullable|integer|min:0|max:30',
            'months' => 'nullable|integer|min:0|max:11',
            'notes' => 'nullable|string',
        ]);

        $years = $request->years ? $request->years . ' años' : '';
        $months = $request->months ? $request->months . ' meses' : '';
        $ageFormatted = trim("$years $months") ?: 'No especificada';

        Pet::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'species' => $request->species,
            'breed' => $request->breed ?? 'N/A',
            'age' => $ageFormatted,
            'notes' => $request->notes,
        ]);

        return redirect()->route('cliente.mascotas.index')->with('success', 'Mascota registrada exitosamente.');
    }

    public function edit(Pet $mascota)
    {
        if ($mascota->user_id !== Auth::id()) {
            abort(403);
        }
        return view('cliente.pets.edit', compact('mascota'));
    }

    public function update(Request $request, Pet $mascota)
    {
        if ($mascota->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:100',
            'species' => 'required|string',
            'breed' => 'nullable|string|max:100',
            'age' => 'nullable|string|max:50',
            'notes' => 'nullable|string',
        ]);

        $mascota->update($request->all());

        return redirect()->route('cliente.mascotas.index')->with('success', 'Información de la mascota actualizada.');
    }

    public function destroy(Pet $mascota)
    {
        if ($mascota->user_id !== Auth::id()) {
            abort(403);
        }

        $mascota->delete();
        return redirect()->route('cliente.mascotas.index')->with('success', 'Mascota eliminada del sistema.');
    }
}