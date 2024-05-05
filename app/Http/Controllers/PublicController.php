<?php
/**
 * Created By - Adithya Prasad
 * Date - 05/03/2024
*/
namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\DoctorSpecialization;
use App\Models\Specialization;
use App\Models\TimeSlot;
use Illuminate\Support\Facades\DB;


class PublicController extends Controller
{
    /**
     * View the specialization for public
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function specialization()
    {
        $specialization = Specialization::all();
        return view('web.pages.specialization.index', compact('specialization'));
    }


    /**
     * To view Doctors for a perticular specialization for public
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
        return view('web.pages.doctor.index', ['results' => $results, 'specializations' => $specializations]);
    }


    /**
     * To show doctor details with slots available
     *
     * @param Doctor $doctor
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
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

        return view('web.pages.doctor.show', compact('doctor', 'slotEvents'));
    }
}
