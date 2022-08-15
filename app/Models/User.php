<?php

namespace App\Models;

use App\Notifications\UserVerifyNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $table = 'users';

    protected $fillable = ['name', 'phone', 'city', 'address', 'email', 'password', 'provider_id', 'provider','email_verified_at'];

    protected $hidden = ['password', 'remember_token',];

    protected $casts = ['email_verified_at' => 'datetime',];

    public function sendEmailVerificationNotification()
    {
        $this->notify(new UserVerifyNotification());
    }

    public function Orders()
    {
        return $this->hasMany(Order::class, 'user');
    }

    public function Likes()
    {
        return $this->hasMany(Like::class, 'user');
    }

    public function City()
    {
        return $this->belongsTo(City::class, 'city');
    }
}
