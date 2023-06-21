<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\DormitoryRequest;
use App\Http\Resources\DormitoryResource;
use App\Models\Dormitory;
use App\Services\DormitoryService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DormitoryController extends Controller
{

    /**
     * Dormitory page view
     */
    public function index(Request $request)
    {
        $showCreateModal = false;
        if ($request->show_modal == 'create') {
            $showCreateModal = true;
        }
        return view('admin.dormitory.dormitory', compact('showCreateModal'));
    }

    /**
     * getting dormitory list for jax call
     */
    public function dormitoryListAjax(Request $request, Dormitory $dormitory)
    {
        $dormitoryList = $dormitory->getDormitoryData($request);
        $data = array();

        if (!empty($dormitoryList['items'])) {
            $data = $dormitory->getDatatableData($dormitoryList['items']);
        }
        return ResponseHelper::getResponseForDatatable($request->input('draw'), $dormitoryList['totalData'], $dormitoryList['totalFiltered'], $data);
    }

    /**
     * dormitory store functionality
     * @param DormitoryRequest $request
     */
    public function store(DormitoryRequest $request, DormitoryService $dormitoryService)
    {
        $requestData = $request->validated();
        if (!isset($requestData['status'])) {
            $requestData['status'] = 0;
        }
        try {
            $data = $dormitoryService->createOrUpdateDormitory($requestData);
            return ResponseHelper::successResponse(trans('messages.create_message'), $data);
        } catch (Exception $e) {
            return ResponseHelper::errorMessage($e->getMessage());
        }
    }

    /**
     * view single dormitory details data
     * @param Dormitory $dormitory
     * @return JsonResponse
     */
    public function viewDetailsAjax(Dormitory $dormitory)
    {
        try {
            return new DormitoryResource($dormitory);
        } catch (Exception $e) {
            return ResponseHelper::errorMessage($e->getMessage());
        }
    }

    /**
     * delete dormitory data by id
     * @param Dormitory $dormitory
     * @return JsonResponse
     */
    public function deleteDormitory(Dormitory $dormitory): JsonResponse
    {
        try {
            $dormitory->delete();
            return ResponseHelper::successResponse(trans('messages.delete_message'));
        } catch (Exception $e) {
            return ResponseHelper::errorMessage($e->getMessage());
        }
    }
}
