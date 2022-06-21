<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WritersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->full_name,
            'email' => $this->email,
            'profile_image' => url('/') . '/storage/' . $this->photo,
            'percentage' => $this->percentage,
            'digit' => $this->digit,
            'ratings_received' => $this->ratings_received->avg('number'),
            'completed_orders' => $this->completed_orders_count,
        ];
    }
}
