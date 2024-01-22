<?php

namespace App\Http\Resources\Website;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    /**
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        $response = parent::toArray($request);
        return $response;
    }
}
