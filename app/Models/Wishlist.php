<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $primaryKey = 'wishlistId';

    
    protected $fillable = [
        'userId',
        'productId',
    ];


    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
    
}
