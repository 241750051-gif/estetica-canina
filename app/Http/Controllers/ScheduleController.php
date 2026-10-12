<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::all();
        return view('encargado.schedules.index', compact('schedules'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $schedule->update([
            'is_active' => !$schedule->is_active
        ]);

        return redirect()->route('encargado.schedules.index')->with('success', 'Estado del horario actualizado correctamente.');
    }
}