<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $primaryKey = 'userId';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'password',
        'phone',
        'image'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function getFullNameAttribute()
	{
		return ucfirst($this->firstName) . ' ' . ucfirst($this->lastName);
	}

	public function carts(): HasMany
	{
		return $this->hasMany(Cart::class, 'userId');
	}
 
	public function addresses(): HasMany
	{
		return $this->hasMany(Address::class, 'userId');
	}

	public function ratings(): HasMany
	{
		return $this->hasMany(Rating::class, 'userId');
	}

	public function wishlistsIds()
	{
		return $this->belongsToMany(Product::class, 'wishlists', 'userId', 'productId')->pluck('productId');
	}

    public function wishlists()
    {
        return $this->belongsToMany(Product::class, 'wishlists', 'userId', 'productId');
    }

}
