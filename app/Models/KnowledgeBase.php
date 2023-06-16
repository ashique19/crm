<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class KnowledgeBase extends Model
{

    protected $table = 'knowledge_base';

    protected $fillable = [
        'user_id', 'category_id', 'name', 'file', 'active'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function scopeActive()
    {
        return $this->where('status', true);
    }

}
