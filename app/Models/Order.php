<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Order extends Model
{
    use HasFactory;
	
	protected $primaryKey = 'orderId';

	protected $fillable = [
		'status',
		'totalPrice',
		'addressId',
		'userId'
	];



	public function orderItems(): HasMany
	{
		return $this->hasMany(OrderItem::class, 'orderId');
	}


	public function address()
	{
		return $this->belongsTo(Address::class,'addressId');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'userId');
	}

}
