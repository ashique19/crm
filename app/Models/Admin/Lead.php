<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $table = 'leads';
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'status',
        'email',
        'phone',
        'conversion_point'
    ];
}
