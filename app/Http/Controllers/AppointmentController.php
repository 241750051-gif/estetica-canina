<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Pet;
use App\Models\Service;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function clientDashboard()
    {
        $user = Auth::user();
        $pets = $user->pets;
        $petsCount = $pets->count();
        $appointmentsCount = $user->appointments()->count();
        $appointments = $user->appointments()->with(['pet', 'services'])->latest()->take(5)->get();

        return view('cliente.dashboard', compact('pets', 'petsCount', 'appointmentsCount', 'appointments'));
    }

    public function clientIndex()
    {
        $appointments = Auth::user()->appointments()->with(['pet', 'services'])->latest()->get();
        return view('cliente.appointments.index', compact('appointments'));
    }

    public function create()
    {
        $pets = Auth::user()->pets;
        $services = Service::where('is_active', true)->get();
        $schedules = Schedule::where('is_active', true)->get();

        // Generar franjas horarias válidas de 09:00 a 18:00
        $timeSlots = [
            '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00'
        ];

        return view('cliente.appointments.create', compact('pets', 'services', 'schedules', 'timeSlots'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pet_id' => 'required|exists:pets,id',
            'service_id' => 'required|exists:services,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required',
        ], [
            'appointment_date.after_or_equal' => 'Debes seleccionar una fecha de hoy en adelante.',
            'appointment_time.required' => 'Debes seleccionar un horario válido.'
        ]);

        $appointment = Appointment::create([
            'user_id' => Auth::id(),
            'pet_id' => $request->pet_id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'status' => 'Pendiente',
            'notes' => $request->notes,
        ]);

        $service = Service::find($request->service_id);
        $appointment->services()->attach($service->id, ['price' => $service->price]);

        return redirect()->route('cliente.appointments.index')->with('success', 'Solicitud de cita enviada exitosamente.');
    }

    public function cancel(Appointment $appointment)
    {
        if ($appointment->user_id !== Auth::id()) {
            abort(403);
        }

        $appointment->update(['status' => 'Cancelada']);
        return redirect()->back()->with('success', 'La cita ha sido cancelada.');
    }

    public function managerDashboard()
    {
        $totalAppointments = Appointment::count();
        $pendingAppointments = Appointment::where('status', 'Pendiente')->count();
        $todayAppointments = Appointment::whereDate('appointment_date', now()->today())->count();
        $servicesCount = Service::count();
        $schedules = Schedule::all();

        return view('encargado.dashboard', compact(
            'totalAppointments', 
            'pendingAppointments', 
            'todayAppointments', 
            'servicesCount', 
            'schedules'
        ));
    }

    public function managerIndex()
    {
        $appointments = Appointment::with(['user', 'pet', 'services'])->latest()->get();
        return view('encargado.appointments.index', compact('appointments'));
    }

    public function updateStatus(Request $request, Appointment $appointment)
    {
        $request->validate(['status' => 'required|in:Pendiente,Confirmada,Completada,Cancelada']);
        $appointment->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Estado de la cita actualizado.');
    }
}