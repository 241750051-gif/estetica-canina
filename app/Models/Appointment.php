<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = ['user_id', 'pet_id', 'appointment_date', 'appointment_time', 'status', 'notes'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'appointment_services')->withPivot('price');
    }
}