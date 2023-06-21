<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Resources\RoomTypeResource;
use Exception;
use Illuminate\Http\JsonResponse;

class RoomTypeController extends Controller
{
    /**
     * get room type index page
     */
    public function index(Request $request)
    {
        $showCreateModal = false;
        if ($request->show_modal == 'create') {
            $showCreateModal = true;
        }
        return view('admin.room-type.room-type', compact('showCreateModal'));
    }

    /**
     * get room type list
     * @param Request $request
     * @param RoomType $roomType
     * @return JsonResponse
     */
    public function roomTypeListAjax(Request $request, RoomType $roomType): JsonResponse
    {
        try {
            $roomTypeList = $roomType->getRoomTypeData($request);
            $data = array();

            if (!empty($roomTypeList['items'])) {
                $data = $roomType->getDatatableData($roomTypeList['items']);
            }
            return ResponseHelper::getResponseForDatatable($request->input('draw'), $roomTypeList['totalData'], $roomTypeList['totalFiltered'], $data);
        } catch (Exception $e) {
            return ResponseHelper::errorMessage($e->getMessage());
        }
    }

    /**
     * view room type details by id
     * @param RoomType $roomType
     * @return JsonResponse
     */
    public function viewDetailsAjax(RoomType $roomType): JsonResponse
    {
        try {
            return new RoomTypeResource($roomType);
        } catch (Exception $e) {
            return ResponseHelper::errorMessage($e->getMessage());
        }
    }

    /**
     * delete room type by id
     * @param RoomType $roomType
     * @return JsonResponse
     */
    public function deleteRoomType(RoomType $roomType): JsonResponse
    {
        try {
            $roomType->delete();
            return ResponseHelper::successResponse(trans('messages.delete_message'));
        } catch (Exception $e) {
            return ResponseHelper::errorMessage($e->getMessage());
        }
    }
}
