<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rating extends Model
{
    use HasFactory;

	protected $primaryKey = 'ratingId';

	protected $fillable = [
		'review',
		'rating',
		'userId',
		'productId'
	];

	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class, 'userId');
	}

	public function product(): BelongsTo
	{
		return $this->belongsTo(Product::class, 'productId');
	}

	

}
