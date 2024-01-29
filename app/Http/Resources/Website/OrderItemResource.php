<?php

namespace App\Http\Resources\Website;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
        "orderItemId" => $this->orderItemId,
        "orderId" => $this->orderId,
        "productId" => $this->productId,
        "quantity" => $this->quantity,
        "price" => $this->price,
        'product'  => new ProductResource($this->whenLoaded('product')),
        ];

    }
}
