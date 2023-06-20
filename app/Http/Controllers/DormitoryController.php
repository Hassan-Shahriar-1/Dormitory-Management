<?php

namespace App\Http\Controllers;

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
    public function dormitoryList()
    {
        $dormitoryList = Dormitory::all();
        return $dormitoryList;
    }
}
