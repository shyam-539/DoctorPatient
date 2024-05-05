<?php
/**
 * Created By - Adithya Prasad
 * Date - 07/03/2024
*/
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Mail\BookingApprovedMail;
use App\Mail\BookingRejectedMail;
use App\Models\BookingRequest;
use App\Models\CancelRequest;
use App\Models\Requests;
use App\Models\TimeSlot;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class RequestController extends BaseController
{
    public function __construct(Request $request) {
        parent::__construct($request);
    }



    /**
     *View user Requested bookings
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    */
    public function viewBookings()
    {
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
                ->where('booking_requests.status', '!=', 1)
                // ->whereDate('booking_requests.selected_date', '>=', $today)
                ->orderBy('booking_requests.selected_date', 'DESC')
                ->get();
        return view('admin.pages.user.booking-request',compact('booking'));
    }


    /**
     * View the Approved booking Request
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function ViewApprovedBookings()
    {
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
                ->where('booking_requests.status', '=', 1)
                // ->whereDate('booking_requests.selected_date', '>=', $today)
                ->orderBy('booking_requests.selected_date', 'DESC')
                ->get();

        return view('admin.pages.user.booking-appoinments',compact('booking'));
    }


    /**
     *View pending User Profile
     *
     * @param Requests $requests
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function ViewPatientDetails(BookingRequest $bookingRequest, Request $request)
    {
        $bookings = $request->booking;
        $bookingId=$bookingRequest->id;
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
                'booking_requests.start_time',
                'booking_requests.end_time',
                'booking_requests.patient_id',
                'booking_requests.status',
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

        return view('admin.pages.user.patient-details',compact('ViewPatientDetails'));
    }


     /**
     * Approve Booking Request
     *
     * @param mixed $bookingId
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approve(BookingRequest $bookingId)
    {
        BookingRequest::where('id', $bookingId->id)->update(['status' => '1']);
        TimeSlot::whereDate('date', $bookingId->selected_date)->whereTime('start_time',$bookingId->start_time)->where('doctor_id',$bookingId->doctor_id)->update(['status' => '1']);
        $booking = BookingRequest::join('doctors', 'booking_requests.doctor_id', '=', 'doctors.id')
        ->join('specializations', 'booking_requests.specialization_id', '=', 'specializations.id')
        ->join('users', 'booking_requests.user_id', '=', 'users.id')
        ->select('booking_requests.*', 'doctors.name as doctor_name', 'specializations.specialization as specialization_name', 'users.email','users.name')
        ->findOrFail($bookingId->id);

        Mail::to($booking->email)->send(new BookingApprovedMail($booking));

        return redirect()->route('admin.request.appoinments')->with('success',"Consultation request approved and mail sent");
    }


    /**
     * View the Approved Patient Details
     *
     * @param BookingRequest $bookingRequest
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function ViewApprovedPatientDetails(BookingRequest $bookingRequest, Request $request)
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

        return view('admin.pages.user.approved-patient-details', compact('ViewPatientDetails'));
    }


    /**
     * Show the form for giving reason of rejection
     *
     * @param Request $request
     * @param mixed $bookingId
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function ShowRejectionForm(Request $request, $bookingId)
    {
        return view('admin.pages.user.cancel-reason',compact('bookingId'));
    }



    /**
     * store the data at the time of rejection
     *
     * @param Request $request
     * @param mixed $bookingId
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeRejection(Request $request, $bookingId)
    {
        CancelRequest::create([
            'booking_request_id' => $request->booking_request_id,
            'reason' => $request->reason,
        ]);

        BookingRequest::where('id', $bookingId)->update(['status' => '2']);

        $booking = BookingRequest::leftJoin('doctors', 'booking_requests.doctor_id', '=', 'doctors.id')
            ->leftJoin('specializations', 'booking_requests.specialization_id', '=', 'specializations.id')
            ->leftJoin('users', 'booking_requests.user_id', '=', 'users.id')
            ->leftJoin('cancel_requests', 'booking_requests.id', '=', 'cancel_requests.booking_request_id') // Join cancel_requests table
            ->select('booking_requests.*', 'doctors.name as doctor_name', 'specializations.specialization as specialization_name','users.name', 'users.email', 'cancel_requests.reason')
            ->findOrFail($bookingId);

        Mail::to($booking->email)->send(new BookingRejectedMail($booking));

        return redirect()->route('admin.request.bookings', ['bookingId' => $bookingId])->with('success',"Consultation request Canceled. Message send.");
    }


    /**
     *View cancelled User Profile
     *
     * @param Requests $requests
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function ViewPatientCancelledDetails(BookingRequest $bookingRequest, Request $request)
    {
        $bookings = $request->booking;
        $bookingId=$bookingRequest->id;
        $ViewPatientDetails = BookingRequest::select(
                'users.id AS userId',
                'patients.id AS patientId',
                'patients.name',
                'patients.email',
                'patients.phone',
                'patients.address',
                'patients.date_of_birth',
                'patients.gender',
                'cancel_requests.booking_request_id',
                'cancel_requests.reason',
                'patients.uploads',
                'doctors.name AS doctor_name',
                'booking_requests.id AS bookingId',
                'booking_requests.selected_date',
                'booking_requests.start_time',
                'booking_requests.end_time',
                'booking_requests.patient_id',
                'booking_requests.status',
                'specializations.specialization')
                ->join('users', 'users.id', '=', 'booking_requests.user_id')
                ->join('cancel_requests', 'cancel_requests.booking_request_id', '=', 'booking_requests.id')
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

        return view('admin.pages.user.cancel-patient-details',compact('ViewPatientDetails'));
    }
}
