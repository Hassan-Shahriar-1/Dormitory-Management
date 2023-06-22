<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentDormitoryResource extends JsonResource
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
            'first_name' => $this->student->first_name,
            'last_name' => $this->student->last_name,
            'address' => $this->student->address,
            'room_number' => $this->room->room_number,
            'room_type' => $this->room->roomType->name,
            'room_id' => $this->room->id,
            'dormitory_name' => $this->room->dormitory->name
        ];
    }
}
