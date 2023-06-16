<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Category extends Model
{

    protected $table = 'categories';

    protected $fillable = [
        'name', 'description', 'alias', 'active', 'order'
    ];

    protected $visible = [
        'name', 'description', 'alias', 'active', 'order'
    ];

    public function scopeActive()
    {
        return $this->where('active', true);
    }

    public function knowledge()
    {
        return $this->hasMany(KnowledgeBase::class)->orderBy('created_at', 'desc');
    }

}
