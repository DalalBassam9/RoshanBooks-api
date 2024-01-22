<?php

namespace App\Http\Resources\Website;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $response = [
            "cartId" => $this->cartId,
            "productId" => $this->productId,
            "quantity" => $this->quantity,
            "name" => $this->product->name ?? '',
            "price" => $this->product->price ?? '',
            "image"  =>  asset('storage/' .$this->product->image) ?? '',
        ];
        return $response;
    }
}
