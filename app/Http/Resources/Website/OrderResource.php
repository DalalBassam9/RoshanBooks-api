<?php

namespace App\Http\Resources\Website;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
         return [
             "orderId" => $this->orderId,
             "userId" => $this->userId,
             "addressId" => $this->addressId,
             "totalPrice" => $this->totalPrice,
             'address'  => new AddressResource($this->whenLoaded('address')),
             'orderItems' => OrderItemResource::collection($this->whenLoaded('orderItems')),
        ];


    }
}
