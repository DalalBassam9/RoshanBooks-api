<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'productId';

    protected $fillable = [
        'name',
        'categoryId',
        'description',
        'price',
        'image'  ,
        'quantity' ,

    ];

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class, 'productId');
    }

    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class, 'productId');
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(orderItem::class, 'productId');
    }


    public function wishlists()
    {
        return $this->belongsToMany(User::class, 'wishlists', 'productId', 'userId');
    }

}



