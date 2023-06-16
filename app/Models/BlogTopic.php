<?php
namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;


class BlogTopic extends Model
{

    // No timestamps
    public $timestamps = false;
    // Allow columns to be filled with data
    protected $fillable = [
        'topic'
    ];
}
