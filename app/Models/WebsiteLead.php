<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class WebsiteLead extends Model
{
    protected $fillable = [
        'user_id', 'website_id', 'first_name','last_name','phone','email','status','conversion_point'
    ];
}
