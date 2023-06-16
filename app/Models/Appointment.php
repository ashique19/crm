<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Appointment extends Model
{

    protected $fillable = [
        'user_id',
        'appointment_availability_id',
        'appointment_service_id',
        'appointment_type',
        'first_name',        
        'last_name',
        'email',
        'phone',
        'email_notification',
        'sms_notification',
        'active',
    ];
    public function appointment_services()
    {
        return $this->hasOne('App\Models\AppointmentService', 'id', 'appointment_service_id');
    }
    public function appointment_avail()
    {
        return $this->hasOne('App\Models\AppointmentAvailability', 'id', 'appointment_availability_id');
    }
    public function profile()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
}
