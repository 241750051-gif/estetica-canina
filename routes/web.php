<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\AppointmentController;

// Rutas Públicas
Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/servicios-publicos', [LandingController::class, 'services'])->name('public.services');

// Autenticación
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Módulo Cliente
Route::middleware(['auth', 'role:cliente'])->prefix('cliente')->name('cliente.')->group(function () {
    Route::get('/dashboard', [AppointmentController::class, 'clientDashboard'])->name('dashboard');
    Route::resource('mascotas', PetController::class);
    Route::get('/citas', [AppointmentController::class, 'clientIndex'])->name('appointments.index');
    Route::get('/citas/nueva', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::post('/citas', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::delete('/citas/{appointment}', [AppointmentController::class, 'cancel'])->name('appointments.cancel');
});

// Módulo Encargado
Route::middleware(['auth', 'role:encargado'])->prefix('encargado')->name('encargado.')->group(function () {
    Route::get('/dashboard', [AppointmentController::class, 'managerDashboard'])->name('dashboard');
    Route::get('/citas', [AppointmentController::class, 'managerIndex'])->name('appointments.index');
    Route::put('/citas/{appointment}', [AppointmentController::class, 'updateStatus'])->name('appointments.update');
    
    Route::resource('servicios', ServiceController::class);
    Route::get('/horarios', [ScheduleController::class, 'index'])->name('schedules.index');
    Route::put('/horarios/{schedule}', [ScheduleController::class, 'update'])->name('schedules.update');
});