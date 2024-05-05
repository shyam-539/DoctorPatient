<?php

use App\Http\Controllers\User\BookingController;
use App\Http\Controllers\User\ConsultationController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\DoctorController;
use App\Http\Controllers\User\RequestsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'user', 'namespace' => 'User', 'as' => 'user.'], function () {
    Auth::routes();

    Route::group(['middleware' => ['auth:user']], function() {

        // Route::get('/home', [HomeController::class, 'index'])->name('home');

        Route::get('',[DashboardController::class,'dashboard'])->name('dashboard');


        Route::group(['prefix' => 'doctor', 'as' => 'doctor.'], function () {
            Route::get('/specialization/index', [DoctorController::class, 'specialization'])->name('specialization.index');
            Route::get('/index/{specialization}',[DoctorController::class, 'UserIndex'])->name('index');
            Route::get('/show/{doctor}',[DoctorController::class, 'show'])->name('show');
            Route::get('/bookings/{doctor}',[DoctorController::class, 'bookings'])->name('bookings');

            // Route::post('contact-us', [ContactController::class, 'store'])->name('contact.us.store');

            Route::post('/storeBookings',[DoctorController::class,'storeBookingRequests'])->name('store_bookings');
        });


        Route::group(['prefix' => 'request', 'as' => 'request.'], function () {
            Route::get('/ViewRequests',[RequestsController::class,'ViewBookingStatus'])->name('view_request');
            Route::get('/cancel',[RequestsController::class,'CancelRequest'])->name('cancel');
        });


        Route::group(['prefix' => 'booking', 'as' => 'booking.'], function () {
            Route::get('/ViewAppoinmentStatus',[BookingController::class,'ViewAppoinmentStatus'])->name('view_appoinment');
            Route::get('/patient-details/{bookingRequest}',[BookingController::class,'ViewPatientDetails'])->name('patient_details');
            Route::get('/cancel-patient-details/{bookingRequest}',[BookingController::class,'ViewCancelledPatientDetails'])->name('cancel_patient_details');
            Route::get('/prescription/{bookingId}',[BookingController::class,'prescription'])->name('prescription');

        });


        Route::get('/booking/consulations',[ConsultationController::class,'ViewConsultationStatus'])->name('booking.consultation');
    });
});
