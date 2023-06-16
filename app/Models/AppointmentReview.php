<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppointmentReview extends Model
{
    protected $fillable = ['user_id','appointment_id','rating','review','active'];

    public function appointment()
    {
        return $this->hasOne('App\Models\Appointment', 'id', 'appointment_id');
    }
}