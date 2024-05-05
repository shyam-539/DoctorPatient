<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PrescriptionController;
use App\Http\Controllers\Admin\RequestController;
use App\Http\Controllers\Admin\SlotController;
use App\Http\Controllers\Admin\SpecializationController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function () {
    Auth::routes();

    Route::group(['middleware' => ['auth:admin']], function() {

        Route::get('/home', [HomeController::class, 'index'])->name('home');

        Route::get('',[DashboardController::class,'dashboard'])->name('admin-dashboard');

        Route::resource('/specialization',SpecializationController::class);

        Route::resource('/doctor',DoctorController::class);

        Route::get('/user/view-user',[UserController::class,'users'])->name('user.view-user');


        Route::group(['prefix' => 'prescription', 'as' => 'prescription.'], function () {
            Route::get('/show/{bookingId}',[PrescriptionController::class,'ShowPrescription'])->name('show');
            Route::post('/store/{bookingId}',[PrescriptionController::class,'StorePrescription'])->name('store');
        });


        Route::group(['prefix' => 'slot', 'as' => 'slot.'], function () {
            Route::get('/create/{doctor}',[SlotController::class,'create'])->name('create');
            Route::post('/store/{doctor}',[SlotController::class,'StoreSlot'])->name('store');
            Route::get('/create-time/{doctor}',[SlotController::class,'CreateTime'])->name('createTime');
            Route::post('/store-time/{doctor}', [SlotController::class, 'StoreTimes'])->name('StoreTime');
            Route::get('/view-time/{doctor}',[SlotController::class,'ViewTimeSlot'])->name('viewTime');
            Route::get('/destroy/{doctor}', [SlotController::class, 'destroy'])->name('destroy');
            Route::delete('/TimeDestroy/{timeSlot}', [SlotController::class, 'TimeDestroy'])->name('TimeDestroy');
        });


        Route::group(['prefix' => 'request', 'as' => 'request.'], function () {
            Route::get('/bookings',[RequestController::class,'viewBookings'])->name('bookings');
            Route::get('/appoinments',[RequestController::class,'ViewApprovedBookings'])->name('appoinments');
            Route::get('/patient-details/{bookingRequest}',[RequestController::class,'ViewPatientDetails'])->name('patient_details');
            Route::get('/cancel_patient-details/{bookingRequest}',[RequestController::class,'ViewPatientCancelledDetails'])->name('cancel_patient_details');
            Route::get('/approved-patient-details/{bookingRequest}',[RequestController::class,'ViewApprovedPatientDetails'])->name('approved_patient_details');
            Route::get('/rejection-form/{bookingId}',[RequestController::class,'ShowRejectionForm'])->name('rejection');
            Route::post('/store-rejection/{bookingId}', [RequestController::class, 'storeRejection'])->name('store_rejection');
            Route::get('/approve/{bookingId}',[RequestController::class,'approve'])->name('approve');
        });


    });
});


