<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebsiteThemeFrames extends Model
{
    protected $fillable = ['website_theme_page_id','content','height','original_url','loaderfunction'];
}
