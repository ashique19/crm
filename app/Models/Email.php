<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Email extends Model
{

    protected $table = 'emails';
    
    protected $fillable = [
        'user_id', 'email'
    ];        
    
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }   

}
