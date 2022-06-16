<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::redirect('/', '/index')
Route::get('/', [MainController::class, 'index'])->name('overview');
Route::get('/maintenance', [MaintenanceController::class, 'index'])->name('maintenance');
Route::get('/users', [MainController::class, 'users'])->name('users');

Route::get('/assets', [AssetController::class, 'index'])->name('assets');
Route::get('/assets/create', [AssetController::class, 'create'])->name('new asset');
Route::post('/assets/store', [AssetController::class, 'store'])->name('store asset');
Route::post('/assets/filter', [AssetController::class, 'filter'])->name('filter assets');

Route::post('/staff/check-id', [StaffController::class, 'checkStaffID'])->name('check staff-id');
Route::post('/staff/store', [StaffController::class, 'store'])->name('store staff');
