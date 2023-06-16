<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Article extends Model
{
    // No timestamps
    public $timestamps = false;

    // Allow columns to be filled with data
    protected $fillable = [
        'category', 'article'
    ];

}
