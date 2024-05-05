<?php
/**
 * Created By - Adithya Prasad
 * Date - 01/03/2024
*/
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\Admin\CreateSlotRequest;
use App\Models\Doctor;
use App\Models\Slot;
use App\Models\TimeSlot;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SlotController extends BaseController
{
    public function __construct(Request $request) {
        parent::__construct($request);
    }


    /**
     * Show the form for creating a new resource.
     *
     *@param \App\Models\Doctor $doctor
     *@return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create(Doctor $doctor)
    {
        $slot = Slot::where('doctor_id', $doctor->id)->get();
        return view('admin.pages.slot.create', compact('doctor', 'slot'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param CreateSlotRequest $request
     * @param Doctor $doctor
     * @return \Illuminate\Http\RedirectResponse
     */
    public function StoreSlot(CreateSlotRequest $request, Doctor $doctor)
    {
        DB::beginTransaction();
        try {
            if ($request->has('dates')) {

                $dates = explode(', ', $request->dates);
                foreach ($dates as $date) {

                    Slot::create([
                        'doctor_id' => $doctor->id,
                        'dates' => $date,
                    ]);
                }
                DB::commit();
            }
        } catch (\Exception $e) {
            DB::rollBack();
        }
        return redirect()->route('admin.doctor.show',['doctor'=>$doctor->id])->with('success',"Slots for Doctor Added Successfully");
    }


    /**
     * View for add time for doctor
     *
     * @param Request $request
     * @param Doctor $doctor
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function CreateTime( Request $request, Doctor $doctor)
    {
        $selectedDate = $request->selected_date;

        $timeSlots = TimeSlot::where('doctor_id', $doctor->id)
                            ->whereDate('date', $selectedDate)
                            ->get();
        return view('admin.pages.slot.create-time', ['doctor' => $doctor,'timeSlots' => $timeSlots, 'selectedDate' => $selectedDate]);
    }


    /**
     * Store the created data
     *
     * @param Request $request
     * @param Doctor $doctor
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeTimes(Doctor $doctor,Request $request )
    {
        $date = Carbon::parse($request['date'])->format('Y-m-d');

        TimeSlot::where('doctor_id', $doctor->id)
                ->where('date', $date)
                ->delete();

        foreach ($request['start_times'] as $key => $startTime) {
            $endTime = $request['end_times'][$key];

            TimeSlot::create([
                'doctor_id' => $doctor->id,
                'date' => $date,
                'start_time' => $startTime,
                'end_time' => $endTime,
            ]);
        }

        return redirect()->route('admin.doctor.show', $doctor->id)->with('success', 'Time slots added successfully');
    }


    /**
     * To view the time slot for admin
     *
     * @param Request $request
     * @param Doctor $doctor
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function viewTimeSlot(Request $request, Doctor $doctor)
    {
        $selectedDate = $request->date;

        $timeSlots = TimeSlot::where('doctor_id', $doctor->id)
                            ->whereDate('date', $selectedDate)
                            ->get();
        return view('admin.pages.slot.view-timeSlot', ['timeSlots' => $timeSlots, 'selectedDate'=>$selectedDate]);
    }


    /**
     * to delete the avalibale date of the doctor and  time slot
     * @param Request $request
     * @param Doctor $doctor
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, Doctor $doctor)
    {
        $dateToDelete = $request->selected_date;

        $timeSlotsToDelete = TimeSlot::where('doctor_id', $doctor->id)->whereDate('date', $dateToDelete)->get();
        foreach ($timeSlotsToDelete as $timeSlot) {
            $timeSlot->delete();
        }

        Slot::where('dates', $dateToDelete)->delete();

        return redirect()->route('admin.doctor.show', ['doctor' => $doctor])->with('success', 'Date and associated time slots deleted successfully.');
    }


    /**
     * Function to delete timeslot
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function TimeDestroy(Request $request, TimeSlot $timeSlot)
    {
        if ($request->ajax()) {
            if ($timeSlot) {
                $timeSlot->delete();
                return response()->json(['success' => 'TimeSlot deleted successfully']);
            }
            return response()->json(['error' => 'TimeSlot not found'], 404);
        }
        return abort(404);
    }

}


