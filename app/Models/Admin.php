<?php

namespace App\Models;

use App\Notifications\ResetPasswordNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'admins';

    protected $fillable = ['email', 'username', 'name', 'phone', 'type', 'password'];

    protected $hidden = ['password', 'remember_token'];
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
    public function isAdmin()
    {
        return $this->type === 'Admin';
    }
    public function isPrinter()
    {
        return $this->type === 'Printer';
    }
    public function isDelivery()
    {
        return $this->type === 'Delivery';
    }
}
