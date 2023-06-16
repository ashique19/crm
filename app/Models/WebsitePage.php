<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class WebsitePage extends Model
{

    protected $table = 'website_pages';
    
    protected $fillable = [
        'website_id', 'name'
    ];
    
    public function site()
    {
        return $this->belongsTo('App\Models\Website');
    }
    
    public function frames()
    {
        return $this->hasMany(WebsiteFrame::class, 'page_id');
    }    

}
