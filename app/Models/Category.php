<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function Cards()
    {
        return $this->hasMany(Card::class, 'category');
    }
}
