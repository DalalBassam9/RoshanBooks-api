<?php

namespace App\Http\Resources\Website;
use App\Http\Resources\Website\UserResource; 
use Illuminate\Http\Resources\Json\JsonResource;

class RatingResource extends JsonResource
{
    /**
     * @param $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'ratingId' => $this->userId,
            'review'  => $this->review,
            'rating' => $this->rating,
            'user' => new UserResource($this->whenLoaded('user')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

}