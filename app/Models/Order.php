<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = ['status'];

    public function User()
    {
        return $this->belongsTo(User::class, 'user');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'order_id');
    }

    public function Card()
    {
        return $this->belongsTo(Card::class, 'card');
    }
}
