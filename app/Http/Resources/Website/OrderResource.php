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
        $response = parent::toArray($request);
        $response['address'] = new AddressResource($this->whenLoaded('address'));
        $response['orderItems'] = OrderItemResource::collection($this->whenLoaded('orderItems'));
        return $response;
    }
}
