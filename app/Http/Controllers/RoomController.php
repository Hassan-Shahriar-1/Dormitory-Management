<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Requests\RoomCreateRequest;
use App\Http\Resources\RoomResource;
use App\Services\RoomService;
use Exception;
use Illuminate\Http\JsonResponse;

class RoomController extends Controller
{
    /**
     * get room index page
     */
    public function index(Request $request)
    {
        $showCreateModal = false;
        if ($request->show_modal == 'create') {
            $showCreateModal = true;
        }
        return view('admin.room.room', compact('showCreateModal'));
    }

    /**
     * dormitory store functionality
     * @param DormitoryRequest $request
     * @return JsonResponse
     */
    public function store(RoomCreateRequest $request, RoomService $roomService): JsonResponse
    {
        $requestData = $request->validated();

        if (!isset($requestData['status'])) {
            $requestData['status'] = 0;
        }

        try {
            $data = $roomService->createOrUpdateRoom($requestData);
            return ResponseHelper::successResponse(trans('messages.create_message'), $data);
        } catch (Exception $e) {
            return ResponseHelper::errorMessage($e->getMessage());
        }
    }


    /**
     * get room type list
     * @param Request $request
     * @param Room $room
     * @return JsonResponse
     */
    public function roomListAjax(Request $request, Room $room)
    {
        try {
            $roomList = $room->getRoomData($request);
            $data = array();

            if (!empty($roomList['items'])) {
                $data = $room->getDatatableData($roomList['items']);
            }
            return ResponseHelper::getResponseForDatatable($request->input('draw'), $roomList['totalData'], $roomList['totalFiltered'], $data);
        } catch (Exception $e) {
            return ResponseHelper::errorMessage($e->getMessage());
        }
    }

    /**
     * view room type details by id
     * @param RoomType $roomType
     */
    public function viewDetailsAjax(Room $room)
    {
        try {
            return new RoomResource($room);
        } catch (Exception $e) {
            return ResponseHelper::errorMessage($e->getMessage());
        }
    }

    /**
     * delete room type by id
     * @param RoomType $roomType
     * @return JsonResponse
     */
    public function deleteRoom(Room $room): JsonResponse
    {
        try {
            $room->delete();
            return ResponseHelper::successResponse(trans('messages.delete_message'));
        } catch (Exception $e) {
            return ResponseHelper::errorMessage($e->getMessage());
        }
    }
}
