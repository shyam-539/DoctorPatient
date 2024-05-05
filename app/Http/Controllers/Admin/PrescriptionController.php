<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Mail\SendPrescriptionMail;
use App\Models\BookingRequest;
use App\Models\DoctorPrescription;
use App\Http\Requests\Admin\CreatePrescriptionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class PrescriptionController extends BaseController
{
    public function __construct(Request $request) {
        parent::__construct($request);
    }



    /**
     * Function to show the prescription
     *
     * @param mixed $bookingId
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function ShowPrescription($bookingId)
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
            'specializations.specialization')
            ->join('users', 'users.id', '=', 'booking_requests.user_id')
            ->join('patients', 'patients.id', '=', 'booking_requests.patient_id')
            ->join('doctors', 'doctors.id', '=', 'booking_requests.doctor_id')
            ->join('specializations', 'specializations.id', '=', 'booking_requests.specialization_id')
            ->where('booking_requests.id', $bookingId)
            ->first();

        $prescription = DoctorPrescription::where('booking_id', $bookingId)->first();

       return view('admin.pages.user.prescription',compact('details','prescription'));
    }



    /**
     * Function to store prescription details
     *
     * @param CreatePrescriptionRequest $request
     * @param DoctorPrescription $doctorPrescription
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function StorePrescription(CreatePrescriptionRequest $request, DoctorPrescription $doctorPrescription)
    {
        DoctorPrescription::where('booking_id', $request->booking_id)->delete();
        $prescription = new DoctorPrescription();

        $prescription->user_id = $request->user_id;
        $prescription->doctor_id = $request->doctor_id;
        $prescription->specialization_id = $request->specialization_id;
        $prescription->patient_id = $request->patient_id;
        $prescription->booking_id = $request->booking_id;
        $prescription->medicinal_prescription = $request->medicinal_prescription;
        $prescription->medical_advices = $request->medical_advices;

        $prescription->save();

        $prescriptionDetails = DoctorPrescription::select(
            'booking_requests.selected_date',
            'doctors.name as doctor_name',
            'specializations.specialization',
            'doctor_prescriptions.medicinal_prescription',
            'doctor_prescriptions.medical_advices',
            'users.email')
            ->join('booking_requests', 'doctor_prescriptions.booking_id', '=', 'booking_requests.id')
            ->join('doctors', 'booking_requests.doctor_id', '=', 'doctors.id')
            ->join('users', 'booking_requests.user_id', '=', 'users.id')
            ->join('specializations', 'booking_requests.specialization_id', '=', 'specializations.id')
            ->where('doctor_prescriptions.booking_id', $prescription->booking_id)
            ->first();

        Mail::to($prescriptionDetails->email)->send(new SendPrescriptionMail($prescriptionDetails));

        return redirect()->route('admin.request.appoinments');
    }
}
