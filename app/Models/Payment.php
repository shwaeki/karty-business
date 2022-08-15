<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['payment_status','payment_method', 'payment_id', 'order_id'];

    public function Order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
