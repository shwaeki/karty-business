<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardImage extends Model
{
    public function Card()
    {
        return $this->belongsTo(Card::class, 'card');
    }

    public function getImagePathAttribute()
    {
        return  asset('images/uploads/cards/'.$this->path);
    }
}
