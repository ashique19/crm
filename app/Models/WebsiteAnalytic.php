<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class WebsiteAnalytic extends Model
{
    protected $fillable = [
                            'website_id','user_id','url','referrer','ip','device','device_version','browser','browser_version'
                        ];
}