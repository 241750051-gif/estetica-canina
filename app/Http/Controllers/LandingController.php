<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Schedule;

class LandingController extends Controller
{
    public function index()
    {
        $services = Service::where('is_active', true)->take(3)->get();
        return view('public.landing', compact('services'));
    }

    public function services()
    {
        $services = Service::where('is_active', true)->get();
        return view('public.services', compact('services'));
    }

    public function schedules()
    {
        $schedules = Schedule::where('is_active', true)->get();
        return view('public.schedules', compact('schedules'));
    }

    public function contact()
    {
        return view('public.contact');
    }
}