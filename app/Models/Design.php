<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Design extends Model
{

    protected $table = 'designs';

    public function getMainImageAttribute($value)
    {
        if ($value != '' && $value != 'no_image.jpg') {
                return "/storage/designs/{$value}";
        }

        return '/images/no_image.jpg';
    }
}
