<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DormitoryController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\StudentDormitoryController;
use App\Models\Dormitory;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AdminController::class, 'dashboard'])->name('home');

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

// Logout Route
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['prefix' => 'admin'], function () {
    Route::get('/dormitory', [DormitoryController::class, 'index']);
    Route::get('dormitory/list', [DormitoryController::class, 'dormitoryListAjax'])->name('dormitory.list');
    Route::post('dormitory/store', [DormitoryController::class, 'store'])->name('dormitory.store');
    Route::get('dormitory/{dormitory}', [DormitoryController::class, 'viewDetailsAjax'])->name('view.dormitory');
    Route::delete('dormitory/{dormitory}', [DormitoryController::class, 'deleteDormitory'])->name('delete.dormitory');

    Route::group(['prefix' => 'room'], function () {
        //room type routes
        Route::get('type/index', [RoomTypeController::class, 'index'])->name('room.type.home');
        Route::post('type/store', [RoomTypeController::class, 'store'])->name('room.type.store');
        Route::get('type-list-ajax', [RoomTypeController::class, 'roomTypeListAjax'])->name('room.type.list');
        Route::get('room-type/{roomtype}', [RoomTypeController::class, 'viewDetailsAjax'])->name('view.room.type');
        Route::delete('room-type-delete/{roomtype}', [RoomTypeController::class, 'deleteRoomType'])->name('delete.room.type');

        //room routes
        Route::get('index', [RoomController::class, 'index'])->name('room.home');
        Route::post('store', [RoomTypeController::class, 'store'])->name('room.store');
        Route::get('list-ajax', [RoomController::class, 'roomListAjax'])->name('room.list');
        Route::get('room/{room}', [RoomController::class, 'viewDetailsAjax'])->name('view.room');
        Route::delete('room-delete/{room}', [RoomController::class, 'deleteRoom'])->name('delete.room');
    });

    Route::group(['prefix' => 'student'], function () {
        Route::get('dormitory', [StudentDormitoryController::class, 'index'])->name('student.dormitory.home');
        Route::post('dormitory-store', [StudentDormitoryController::class, 'store'])->name('student.dormitory.store');
        Route::get('student-dormitory-list-ajax', [StudentDormitoryController::class, 'studentDormitoryListAjax'])->name('student.dormitory.list');
        Route::get('student-dormitory/{studentdormitory}', [StudentDormitoryController::class, 'viewStudentDormitoryAjax'])->name('student.dormitory.view');
        Route::delete('dormitory/delete/{studentdormitory}', [StudentDormitoryController::class, 'deleteStudentDormitory'])->name('student.dormitory.delete');
    });
});
