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
            'dormitory_name' => $this->dormitory->name,
            'room_type' => $this->roomtype->name,
            'total_beds' => $this->number_of_beds,
            'status' => $this->status == 1 ? 'Active' : 'Deactive'
        ];
    }
}
