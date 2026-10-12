<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Pet;
use App\Models\Service;
use App\Models\Schedule;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Usuario Encargado
        $encargado = User::create([
            'name' => 'Encargado Principal',
            'email' => 'encargado@estetica.com',
            'password' => Hash::make('password123'),
            'role' => 'encargado',
            'phone' => '555-100-200'
        ]);

        // Usuario Cliente
        $cliente = User::create([
            'name' => 'Juan Perez',
            'email' => 'cliente@estetica.com',
            'password' => Hash::make('password123'),
            'role' => 'cliente',
            'phone' => '555-300-400'
        ]);

        // Registro de Mascota
        Pet::create([
            'user_id' => $cliente->id,
            'name' => 'Firulais',
            'species' => 'Perro',
            'breed' => 'Golden Retriever',
            'age' => 3,
            'notes' => 'Alergico a ciertos champus'
        ]);

        // Servicios Basicos
        Service::create([
            'name' => 'Baño Completo y Secado',
            'description' => 'Servicio de higienizacion profunda, secado y cepillado profesional.',
            'price' => 350.00,
            'duration_minutes' => 60,
            'is_active' => true
        ]);

        Service::create([
            'name' => 'Corte de Pelo Estilizado',
            'description' => 'Corte higienico y estético conforme a la raza de la mascota.',
            'price' => 450.00,
            'duration_minutes' => 90,
            'is_active' => true
        ]);

        Service::create([
            'name' => 'Corte de Uñas y Limpieza Dental',
            'description' => 'Mantenimiento preventivo de uñas y profilaxis superficial.',
            'price' => 200.00,
            'duration_minutes' => 30,
            'is_active' => true
        ]);

        // Horarios Atencion
        $dias = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'];
        foreach ($dias as $dia) {
            Schedule::create([
                'day_of_week' => $dia,
                'start_time' => '09:00:00',
                'end_time' => '18:00:00',
                'is_active' => true
            ]);
        }
    }
}