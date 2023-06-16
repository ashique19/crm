<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class PlanFeature extends Model
{

    protected $table = 'plan_features';
    
    public function features()
    {
        return $this->belongsToMany('App\Models\Feature');
    } 
    
}
