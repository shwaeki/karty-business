<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Card extends Model
{
    protected $table = 'cards';

    public function Orders()
    {
        return $this->hasMany(Order::class, 'card');
    }

    public function Category()
    {
        return $this->belongsTo(Category::class, 'category');
    }

    public function images()
    {
        return $this->hasMany(CardImage::class,'card');
    }


    public function styles()
    {
        return $this->hasMany(CardStyle::class,'card');
    }

    public function Likes()
    {
        return $this->hasMany(Like::class,'card');
    }

    public function getIsLikedAttribute()
    {
        $like = $this->Likes()->whereUser(Auth::id())->where('loved',true)->first();
        return (!is_null($like)) ? true : false;
    }

    public function getDiscountPriceAttribute()
    {
        return $this->price * (1 - $this->discount / 100);
    }

    public function getImagePathAttribute()
    {
        return  asset('images/uploads/cards/'.$this->path);
    }
    public function getMainPathAttribute()
    {
        return  asset('images/uploads/cards/'.$this->path);
    }
}
