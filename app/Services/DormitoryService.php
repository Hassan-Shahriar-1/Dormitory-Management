<?php

namespace App\Services;

use App\Models\Dormitory;

class DormitoryService
{
    /**
     * create or update dormitory
     * @param array $requestData
     * @return object
     */
    public function createOrUpdateDormitory(array $requestData): object
    {
        if (isset($requestData['id']) && $requestData['id'] != null) {
            $dormitory = $this->updateDormitory($requestData);
        } else {
            $dormitory = Dormitory::create($requestData);
        }
        return $dormitory;
    }

    /**
     * update dormitory
     * @param array $dormitoryData
     * @return object
     */
    public function updateDormitory(array $dormitoryData): object
    {
        $data = Dormitory::where('id', $dormitoryData['id'])->first();
        unset($dormitoryData['id']);
        $data->update($dormitoryData);
        return $data;
    }
}
