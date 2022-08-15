<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Icon extends Model
{
    protected $table = 'icons';

    public function getIconPathAttribute()
    {
        return  asset('images/uploads/icons/'.$this->path);
    }
}
