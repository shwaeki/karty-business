<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['name', 'price'];
    public $timestamps = false;

    public function Users()
    {
        return $this->hasMany(User::class, 'city');
    }
}
