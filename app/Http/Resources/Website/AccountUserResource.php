<?php

namespace App\Http\Resources\Website;

use Illuminate\Http\Request;

use Illuminate\Http\Resources\Json\JsonResource;

class AccountUserResource extends JsonResource
{
    /**
     * @param $request
     * @return array
     */

    public function toArray(Request $request): array
    {
        $response = parent::toArray($request);
        return $response;
    }
}
