<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Plan extends Model
{

    public function scopeActive(Builder $builder)
    {
        return $builder->where('active', true);
    }

    public function scopeExcept(Builder $builder, $planId)
    {
        return $builder->where('id', '!=', $planId);
    }
    
    public function features()
    {
        return $this->belongsToMany('App\Models\Feature', 'App\Models\PlanFeature');
    }

    public function planFeatures()
    {
        return $this->hasMany('App\Models\PlanFeature');
    }    
       
}
