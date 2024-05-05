<?php

use App\Http\Controllers\LayoutController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('index');
// });

// Auth::routes();

Route::group(['middleware' => ['guest']], function() {

    Route::get('/', [PublicController::class, 'specialization'])->name('home');
    Route::get('/doctor/index/{specialization}',[PublicController::class, 'UserIndex'])->name('doctor.index');
    Route::get('/doctor/show/{doctor}',[PublicController::class, 'show'])->name('doctor.show');

    Route::get('/adminIndex',[LayoutController::class,'adminIndex'])->name('layouts.admin-index');
    Route::get('/userIndex',[LayoutController::class,'userIndex'])->name('layouts.user-index');
    Route::get('/adminSlotIndex',[LayoutController::class,'adminSlotIndex'])->name('layout.adminSlot-index');

    // Route::get('/index',[Controller::class,'index'])->name('index');
});


