<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class AppointmentAvailability extends Model
{
    protected $table = 'appointment_availability';
    protected $fillable = [
        'user_id',
        'availability',
        'active',
    ];

    public function appointments()
    {
        return $this->hasOne('App\Models\Appointment', 'appointment_availability_id', 'id');
    }  
}
