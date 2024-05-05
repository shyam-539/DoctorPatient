<?php
/**
 * Created By - Adithya Prasad
 * Date - 05/03/2024
*/
namespace App\Http\Controllers\User;

use App\Http\Controllers\User\BaseController;
use App\Models\BookingRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BookingController extends BaseController
{
    public function __construct(Request $request) {
        parent::__construct($request);
    }


    /**
     * View Appoinmentstatus
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function ViewAppoinmentStatus()
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
            // ->whereDate('booking_requests.selected_date', '>=', $today)
            ->orderBy('booking_requests.selected_date', 'DESC')
            ->get();

        return view('user.pages.booking.viewAppoinment', compact('booking'));
    }


    /**
     *  View patient Details
     *
     * @param BookingRequest $bookingRequest
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function ViewPatientDetails(BookingRequest $bookingRequest, Request $request)
    {
        $bookingId = $bookingRequest->id;
        $ViewPatientDetails = BookingRequest::select(
            'users.id AS userId',
            'patients.id AS patientId',
            'patients.name',
            'patients.email',
            'patients.phone',
            'patients.address',
            'patients.date_of_birth',
            'patients.gender',
            'patients.uploads',
            'doctors.name AS doctor_name',
            'booking_requests.id AS bookingId',
            'booking_requests.selected_date',
            'booking_requests.status',
            'booking_requests.start_time',
            'booking_requests.end_time',
            'specializations.specialization')
            ->join('users', 'users.id', '=', 'booking_requests.user_id')
            ->join('patients', 'patients.id', '=', 'booking_requests.patient_id')
            ->join('doctors', 'doctors.id', '=', 'booking_requests.doctor_id')
            ->join('specializations', 'specializations.id', '=', 'booking_requests.specialization_id')
            ->where('booking_requests.id', $bookingId)
            ->first();

        $genderLabels = [
            0 => 'Male',
            1 => 'Female',
            2 => 'Others',
        ];

        $ViewPatientDetails->gender = $genderLabels[$ViewPatientDetails->gender];

        return view('user.pages.booking.patient_details', compact('ViewPatientDetails'));
    }


    /**
     *  View patient Details
     *
     * @param BookingRequest $bookingRequest
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function ViewCancelledPatientDetails(BookingRequest $bookingRequest, Request $request)
    {
        $bookingId = $bookingRequest->id;
        $ViewPatientDetails = BookingRequest::select(
            'users.id AS userId',
            'patients.id AS patientId',
            'patients.name',
            'patients.email',
            'patients.phone',
            'patients.address',
            'patients.date_of_birth',
            'patients.gender',
            'patients.uploads',
            'cancel_requests.booking_request_id',
            'cancel_requests.reason',
            'doctors.name AS doctor_name',
            'booking_requests.id AS bookingId',
            'booking_requests.selected_date',
            'booking_requests.status',
            'booking_requests.start_time',
            'booking_requests.end_time',
            'specializations.specialization')
            ->join('users', 'users.id', '=', 'booking_requests.user_id')
            ->join('patients', 'patients.id', '=', 'booking_requests.patient_id')
            ->join('cancel_requests', 'cancel_requests.booking_request_id', '=', 'booking_requests.id')
            ->join('doctors', 'doctors.id', '=', 'booking_requests.doctor_id')
            ->join('specializations', 'specializations.id', '=', 'booking_requests.specialization_id')
            ->where('booking_requests.id', $bookingId)
            ->first();

        $genderLabels = [
            0 => 'Male',
            1 => 'Female',
            2 => 'Others',
        ];

        $ViewPatientDetails->gender = $genderLabels[$ViewPatientDetails->gender];

        return view('admin.pages.user.cancel-patient-details', compact('ViewPatientDetails'));
    }


    /**
     * View Doctor Prescription
     *
     * @param mixed $bookingId
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function prescription($bookingId)
    {
        $details = BookingRequest::select(
            'users.id AS userId',
            'patients.id AS patientId',
            'doctors.id AS doctorId',
            'specializations.id AS specializationId',
            'patients.name',
            'patients.email',
            'doctors.name AS doctor_name',
            'booking_requests.id AS bookingId',
            'booking_requests.selected_date',
            'booking_requests.start_time',
            'booking_requests.end_time',
            'doctor_prescriptions.medicinal_prescription',
            'doctor_prescriptions.medical_advices',
            'specializations.specialization')
            ->join('users', 'users.id', '=', 'booking_requests.user_id')
            ->join('patients', 'patients.id', '=', 'booking_requests.patient_id')
            ->join('doctors', 'doctors.id', '=', 'booking_requests.doctor_id')
            ->join('doctor_prescriptions', 'doctor_prescriptions.booking_id', '=', 'booking_requests.id')
            ->join('specializations', 'specializations.id', '=', 'booking_requests.specialization_id')
            ->where('booking_requests.id', $bookingId)
            ->first();

       return view('user.pages.booking.prescription',compact('details'));
    }
}
