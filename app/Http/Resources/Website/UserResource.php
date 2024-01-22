<?php

namespace App\Http\Resources\Website;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'userId' => $this->userId,
            'firstName'  => $this->firstName,
            'lastName'  => $this->lastName,
            'phone'     => $this->phone,
            'email'     => $this->email,
            'image' => asset('storage/' . $this->image),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        
        ];
    }
}
