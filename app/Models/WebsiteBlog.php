<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class WebsiteBlog extends Model
{
    protected $fillable = [
        'website_id', 'title', 'content', 'image', 'slug', 'meta_keywords', 'meta_description', 'views','status'
    ];
}
