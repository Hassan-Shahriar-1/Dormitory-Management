<?php

namespace App\Http\Controllers;

use App\Models\StudentDormitory;
use Illuminate\Http\Request;
use Exception;
use App\Helpers\ResponseHelper;
use App\Http\Requests\StudentDormitoryRequest;
use App\Services\RoomService;
use App\Services\StudentDormitoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class StudentDormitoryController extends Controller
{
    /**
     * student dormitory home
     * @param Request $request
     */
    public function index(Request $request)
    {
        $showCreateModal = false;
        if ($request->show_modal == 'create') {
            $showCreateModal = true;
        }
        return view('admin.student.student-dormitory', compact('showCreateModal'));
    }

    /**
     * dormitory store functionality
     * @param DormitoryRequest $request
     */
    public function store(StudentDormitoryRequest $request, StudentDormitoryService $studentDormitoryService)
    {
        $requestData = $request->validated();

        if (!isset($requestData['status'])) {
            $requestData['status'] = 0;
        }
        DB::beginTransaction();
        try {
            $data = $studentDormitoryService->createOrUpdateStudentDormitory($requestData);
            DB::commit();
            return ResponseHelper::successResponse(trans('messages.create_message'), $data);
        } catch (Exception $e) {
            DB::rollBack();
            return ResponseHelper::errorMessage($e->getMessage());
        }
    }

    /**
     * get room type list
     * @param Request $request
     * @param RoomType $roomType
     */
    public function studentDormitoryListAjax(Request $request, StudentDormitory $studentDormitory)
    {
        try {
            $studentDormitoryList = $studentDormitory->getStudentDormitoryData($request);
            $data = array();

            if (!empty($studentDormitoryList['items'])) {
                $data = $studentDormitory->getDatatableData($studentDormitoryList['items']);
            }
            return ResponseHelper::getResponseForDatatable($request->input('draw'), $studentDormitoryList['totalData'], $studentDormitoryList['totalFiltered'], $data);
        } catch (Exception $e) {
            return ResponseHelper::errorMessage($e->getMessage());
        }
    }

    /**
     * view room type details by id
     * @param RoomType $roomType
     * @return JsonResponse
     */
    public function viewDetailsAjax(StudentDormitory $studentDormitory): JsonResponse
    {
        try {
            return $studentDormitory;
        } catch (Exception $e) {
            return ResponseHelper::errorMessage($e->getMessage());
        }
    }

    /**
     * delete room type by id
     * @param RoomType $roomType
     * @return JsonResponse
     */
    public function deleteStudentDormitory(StudentDormitory $studentDormitory): JsonResponse
    {
        try {
            $studentDormitory->delete();
            return ResponseHelper::successResponse(trans('messages.delete_message'));
        } catch (Exception $e) {
            return ResponseHelper::errorMessage($e->getMessage());
        }
    }
}
