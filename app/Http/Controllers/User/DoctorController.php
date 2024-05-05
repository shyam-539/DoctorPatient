<?php
/**
 * Created By - Adithya Prasad
 * Date - 05/03/2024
*/
namespace App\Http\Controllers\User;

use App\Http\Controllers\User\BaseController;
use App\Http\Requests\User\CreatePatientRequest;
use App\Models\BookingRequest;
use App\Models\Doctor;
use App\Models\DoctorSpecialization;
use App\Models\Patient;
use App\Models\Specialization;
use App\Models\TimeSlot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class DoctorController extends BaseController
{
    public function __construct(Request $request) {
        parent::__construct($request);
    }

    /**
     * List All Specialization
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function specialization()
    {
        $specialization = Specialization::all();
        return view('user.pages.specialization.index', compact('specialization'));
    }


    /**
     * To list doctors of a perticular specialization
     *
     * @param Specialization $specialization
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function UserIndex(Specialization $specialization)
    {
        $currentDate = now()->toDateString();
        $specializations = $specialization->specialization;
        $results = DoctorSpecialization::select(
            'doctor_specializations.doctor_id',
            'doctor_specializations.specialization_id',
            'doctors.name',
            'doctors.email',
            'doctors.phone',
            'doctors.id',
            DB::raw('GROUP_CONCAT(DISTINCT doctor_images.image) AS images'),
            DB::raw('GROUP_CONCAT(DISTINCT slots.dates ORDER BY slots.dates) AS available_dates'))
            ->join('doctors', 'doctor_specializations.doctor_id', '=', 'doctors.id')
            ->join('doctor_images', 'doctor_specializations.doctor_id', '=', 'doctor_images.doctor_id')
            ->join('time_slots', 'doctor_specializations.doctor_id', '=', 'time_slots.doctor_id')
            ->join('slots', 'doctor_specializations.doctor_id', '=', 'slots.doctor_id')
            ->where('doctor_specializations.specialization_id', $specialization->id)
            ->whereDate('slots.dates', '>=', $currentDate)
            ->where('time_slots.status', '=', 0)
            ->groupBy('doctor_specializations.doctor_id',
                    'doctor_specializations.specialization_id',
                    'time_slots.status',
                    'doctors.name',
                    'doctors.email',
                    'doctors.phone',
                    'doctors.id')
            ->get();

        foreach ($results as $result) {
            $result->images = explode(',', $result->images);
        }
        return view('user.pages.doctor.index', ['results' => $results, 'specializations' => $specializations]);
    }


    /**
     * To show Doctor details and available dates of doctor
     *
     * @param Doctor $doctor
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     *
     */

     public function show(Doctor $doctor)
    {
        $availableDates = TimeSlot::where('doctor_id', $doctor->id)
                                ->where('status', '=', 0)
                                ->whereDate('date', '>=', now()->toDateString())
                                ->pluck('date')
                                ->unique()
                                ->values();

        $events = [];
        foreach ($availableDates as $date) {
            $timeslotsForDate = TimeSlot::where('doctor_id', $doctor->id)
                                        ->where('status', '=', 0)
                                        ->whereDate('date', $date)
                                        ->get();

            if ($timeslotsForDate->count() > 0) {
                $event = [
                    'title' => 'Available',
                    'start' => $date,
                ];
                $events[] = $event;
            }
        }

        $slotEvents = json_encode($events);

        return view('user.pages.doctor.show', compact('doctor', 'slotEvents'));
    }


    /**
     *To show booking request
     *
     * @param Request $request
     * @param Doctor $doctor
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function bookings(Request $request, Doctor $doctor)
    {
        $selectedDate = $request->input('selected_date');
        $specialization = Specialization::where('id', $request->specialization_id)->first();

        $timeSlots = TimeSlot::where('doctor_id', $doctor->id)
            ->whereDate('date', $selectedDate)
            ->where('status', 0)
            ->get();
        $user = Auth::user();
        return view('user.pages.doctor.bookings', [
            'doctor' => $doctor,
            'selectedDate' => $selectedDate,
            'specialization' => $specialization,
            'user' => $user,
            'timeSlots' => $timeSlots,
        ]);
    }


    /**
     * To store requested bookings
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function StoreBookingRequests(CreatePatientRequest $request)
    {
        $patient = new Patient();
        $patient->user_id = $request->user_id;
        $patient->name = $request->name;
        $patient->gender = $request->gender == 'male' ? 0 : ($request->gender == 'female' ? 1 : 2);
        $patient->date_of_birth = $request->date_of_birth;
        $patient->email = $request->email;
        $patient->phone = $request->phone;
        $patient->address = $request->address;

        if ($request->hasFile('uploads')) {
            $file = $request->file('uploads');
            $fileName = $file->getClientOriginalName();
            $file->storeAs('uploads', $fileName);
            $patient->uploads = $fileName;
        }

        $patient->save();

        $patientId = $patient->id;

        $timeArray = explode('-', $request->time);
        $startTime = trim($timeArray[0]);
        $endTime = trim($timeArray[1]);

        BookingRequest::create([
            'doctor_id' => $request->doctor_id,
            'specialization_id' => $request->specialization_id,
            'user_id' => $request->user_id,
            'patient_id' => $patientId,
            'selected_date' => $request->date,
            'start_time' => $startTime,
            'end_time' => $endTime,
        ]);

        return redirect()->route('user.request.view_request')->with('success', "Booking Successful.");
    }


}
