<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Download extends Model
{

    protected $table = 'downloads';

    protected $fillable = [
        'user_id', 'category_id', 'name', 'file', 'active'
    ];

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function scopeActive()
    {
        return $this->where('active', true);
    }

}
