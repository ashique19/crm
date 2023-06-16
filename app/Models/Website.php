<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Website extends Model
{

    protected $table = 'websites';
    
    protected $fillable = [
        'website_theme_id',
        'user_id', 'website_name', 'website_trashed', 'subdomain',
        'primary_domain',
        'theme_id',
        'logo',
        'description',
        'keywords',
        'seo_image',
        'business_name',
        'business_phone',
        'business_email',
        'business_address',
        'business_address_2',
        'business_city',
        'business_state',
        'business_zip',
        'business_country',
        'monday',
        'monday_start',
        'monday_end',
        'tuesday',
        'tuesday_start',
        'tuesday_end',
        'wednesday',
        'wednesday_start',
        'wednesday_end',
        'thursday',
        'thursday_start',
        'thursday_end',
        'friday',
        'friday_start',
        'friday_end',
        'saturday',
        'saturday_start',
        'saturday_end',
        'sunday',
        'sunday_start',
        'sunday_end',
        'google_tag',
        'header_tag',
        'footer_tag',
        'notification_email_address',
        'notification_email_password',
        'notification_email_server',
        'notification_email_port'           
        
        
    ];
    
    public function page()
    {
        return $this->hasMany('App\Models\WebsitePage');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    
    public function pages()
    {
        return $this->hasMany(WebsitePage::class, 'website_id');
    }
    
    public function frames()
    {
        return $this->hasMany(WebsiteFrame::class, 'website_id');
    }
    
    public function scopeHasId($q, $id)
    {
        return $q->where('id', $id);
    }
    
    public function scopeBelongsToUser($q, $userId)
    {
        return $q->where('user_id', $userId);
    }    
     
}
