<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'room_number' => $this->room_number,
            'dormitory_id' => $this->dormitory->id,
            'room_type_id' => $this->roomtype->id,
            'description' => $this->description,
            'number_of_beds' => $this->number_of_beds,
            'status' => $this->status == 1 ? 'Active' : 'Deactive'
        ];
    }
}
