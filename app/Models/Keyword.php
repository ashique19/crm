<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    // No timestamps
    public $timestamps = false;

    protected $fillable = [
        'keyword', 'used', 'status'
    ];
}
