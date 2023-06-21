<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Requests\RoomCreateRequest;
use App\Http\Requests\RoomTypeRequest;
use App\Http\Resources\RoomTypeResource;
use App\Services\RoomService;
use App\Services\RoomTypeService;
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
     * store room type
     * @param RoomTypeRequest $request
     * @param RoomTypeService $roomTypeService
     * @return JsonResponse
     */
    public function store(RoomCreateRequest $request, RoomService $roomService): JsonResponse
    {
        $requestData = $request->validated();
        if (!isset($requestData['status'])) {
            $requestData['status'] = 0;
        }
        try {
            $roomType = $roomService->createOrUpdateRoomType($requestData);
            return ResponseHelper::successResponse(trans('messages.create_message'), $roomType);
        } catch (Exception $e) {
            return ResponseHelper::errorMessage($e->getMessage());
        }
    }

    /**
     * get room type list
     * @param Request $request
     * @param RoomType $roomType
     * @return JsonResponse
     */
    public function roomTypeListAjax(Request $request, RoomType $roomType)
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
     */
    public function viewDetailsAjax(RoomType $roomType)
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
