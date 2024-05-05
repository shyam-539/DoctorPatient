<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\User\BaseController;
use App\Models\BookingRequest;
use App\Models\CancelRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RequestsController extends BaseController
{
    public function __construct(Request $request) {
        parent::__construct($request);
    }

    /**
     * To view the booking request
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function ViewBookingStatus()
    {
        $user = Auth::user();

        $today = Carbon::today()->toDateString();
        $booking = BookingRequest::select(
            'booking_requests.id AS bookingId',
            'booking_requests.selected_date',
            'booking_requests.start_time',
            'booking_requests.end_time',
            'booking_requests.patient_id',
            'booking_requests.status',
            'patients.name AS patientName',
            'users.id AS userId',
            'doctors.id AS doctorId',
            'doctors.name AS doctorName',
            'specializations.id AS specializationId',
            'specializations.specialization')
            ->join('users', 'booking_requests.user_id', '=', 'users.id')
            ->join('doctors', 'booking_requests.doctor_id', '=', 'doctors.id')
            ->join('patients', 'booking_requests.patient_id', '=', 'patients.id')
            ->join('specializations', 'booking_requests.specialization_id', '=', 'specializations.id')
            ->where('users.id', '=', $user->id)
            ->where('booking_requests.status', '!=', 1)
            ->whereIn('booking_requests.status', [0,2])
            // ->whereDate('booking_requests.selected_date', '>=', $today)
            ->orderBy('booking_requests.selected_date', 'DESC')
            ->get();

        return view('user.pages.booking.ViewBookingStatus',compact('booking'));
    }


    /**
     * function to view the cancelled request
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function CancelRequest()
    {
        $user = Auth::user();
        $booking = CancelRequest::select(
            'cancel_requests.id AS cancelId',
            'cancel_requests.booking_request_id',
            'cancel_requests.reason',
            'booking_requests.id AS bookingId',
            'booking_requests.doctor_id',
            'booking_requests.specialization_id',
            'booking_requests.user_id',
            'booking_requests.patient_id',
            'booking_requests.selected_date',
            'booking_requests.start_time',
            'booking_requests.end_time',
            'booking_requests.status',
            'doctors.name AS doctor_name',
            'patients.name AS patient_name',
            'specializations.specialization')
            ->join('booking_requests', 'cancel_requests.booking_request_id', '=', 'booking_requests.id')
            ->join('doctors', 'booking_requests.doctor_id', '=', 'doctors.id')
            ->join('patients', 'booking_requests.patient_id', '=', 'patients.id')
            ->join('specializations', 'booking_requests.specialization_id', '=', 'specializations.id')
            ->where('booking_requests.user_id', '=', $user->id)
            ->where('booking_requests.status', '=', 2)
            ->orderBy('booking_requests.selected_date', 'DESC')
            ->get();

        return view('user.pages.booking.cancel-message',compact('booking'));
    }
}
