<?php

namespace App\Services;

use App\Models\Room;
use App\Models\RoomType;

class RoomService
{
    /**
     * create or update room type
     * @param array $requestData
     * @return object
     */
    public function createOrUpdateRoomType(array $requestData): object
    {
        if (isset($requestData['id']) && $requestData['id'] != null) {
            $roomType = $this->updateRoomType($requestData);
        } else {
            $roomType = RoomType::create($requestData);
        }
        return $roomType;
    }

    /**
     * update room type data
     * @param array $roomType
     * @return object
     */
    public function updateRoomType(array $roomType)
    {
        $data = RoomType::where('id', $roomType['id'])->first();
        unset($roomType['id']);
        $data->update($roomType);
        return $data;
    }

    /**
     * create or update room
     * @param array $requestData
     * @return object
     */
    public function createOrUpdateRoom(array $requestData): object
    {
        if (isset($requestData['id']) && $requestData['id'] != null) {
            $roomType = $this->updateRoom($requestData);
        } else {
            $roomType = Room::create($requestData);
        }
        return $roomType;
    }

    /**
     * update room
     * @param array $room
     * @return object
     */
    public function updateRoom(array $roomRequestData): object
    {
        $data = Room::where('id', $roomRequestData['id'])->first();
        unset($roomRequestData['id']);
        $data->update($roomRequestData);
        return $data;
    }
}
