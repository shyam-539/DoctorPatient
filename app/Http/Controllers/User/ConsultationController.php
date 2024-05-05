<?php
/**
 * Created By - Adithya Prasad
 * Date - 12/03/2024
*/
namespace App\Http\Controllers\User;

use App\Http\Controllers\User\BaseController;
use App\Models\BookingRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ConsultationController extends BaseController
{
    public function __construct(Request $request) {
        parent::__construct($request);
    }

    /**
     * To view all consultation
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function ViewConsultationStatus()
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
            ->where('booking_requests.status', '=', 1)
            ->whereDate('booking_requests.selected_date', '<=', $today)
            ->orderBy('booking_requests.selected_date', 'ASC')
            ->get();

            // dd($booking);

        return view('user.pages.booking.view-consultation', compact('booking'));
    }
}
