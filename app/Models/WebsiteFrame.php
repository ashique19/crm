<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class WebsiteFrame extends Model
{

    protected $table = 'website_frames';
    
    public function page()
    {
        return $this->belongsTo(WebsitePage::class, 'page_id');
    }
    
    public function site()
    {
        return $this->belongsTo(Website::class, 'website_id');
    }
        
    public function scopeRevision($q, $revision = 0)
    {
        $q->where('revision', $revision);
    }    

}
