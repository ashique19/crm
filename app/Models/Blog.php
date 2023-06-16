<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Notifications\BlogPublished;

class Blog extends Model
{
    use Notifiable;
    protected $table = 'blog';
    
    protected $visible = [
        'user_id', 'title', 'content', 'slug','image'
    ];    
    
    protected $fillable = [
        'user_id', 'title', 'content', 'slug', 'meta_description', 'meta_keywords' ,'status' ,'image'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    
    
    public function scopeHasId($q, $id)
    {
        return $q->where('id', $id);
    }
    
    public function scopeBelongsToUser($q, $userId)
    {
        return $q->where('user_id', $userId);
    }    
     
    public function getImageAttribute($value)
    {
        if ($value != '' && $value != 'no_image.jpg') {
                return $value;
        }
        
        return '/assets/images/no_image.jpg';
    } 
    public function getLink()
    {
        return route('app.blog.view', $this->slug);
    }
            
     
}