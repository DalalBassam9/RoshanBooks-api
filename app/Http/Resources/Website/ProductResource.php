<?php

namespace App\Http\Resources\Website;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array

    {   $user = auth()->user();

        return [
            'productId' => $this->productId,
            'name'  => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'sumRatings' => $this->ratings->count() > 0 ? round($this->ratings->sum('rating') / $this->ratings->count(), 1) : null,
            'countRatings' => $this->ratings->count() > 0 ? $this->ratings->count() : null,
            'image' => asset('storage/' . $this->image),
        ];
    }

}
