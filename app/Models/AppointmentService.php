<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class AppointmentService extends Model
{
    protected $table = 'appointment_services';

    protected $fillable = [
        'user_id',
        'name',
        'duration',
        'appointment_types',
        'first_name',
        'active',
        'amount'
    ];

}
