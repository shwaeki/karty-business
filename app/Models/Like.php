<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public function Card()
    {
        return $this->belongsTo(Card::class, 'card');
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'user');
    }
}
