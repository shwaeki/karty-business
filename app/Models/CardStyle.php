<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardStyle extends Model
{
    protected $guarded  = [];

    public function Card()
    {
        return $this->hasMany(Card::class, 'card');
    }
}
