<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DormitoryController;
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
});
