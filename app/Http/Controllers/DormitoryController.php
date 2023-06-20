<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\DormitoryRequest;
use App\Models\Dormitory;
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
    public function dormitoryList(Request $request, Dormitory $dormitory)
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
    public function store(DormitoryRequest $request)
    {
        $data = Dormitory::create($request->all());
        return ResponseHelper::successResponse(trans('messages.create_message'), $data);
    }
}
