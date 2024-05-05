<?php
/**
 * Created By - Adithya Prasad
 * Date - 28/02/2024
*/
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Constants\DoctorQualificationConstants;
use App\Models\Doctor;
use App\Models\DoctorImage;
use App\Models\Slot;
use App\Models\Specialization;
use App\Models\TimeSlot;
use App\Http\Requests\Admin\CreateDoctorRequest;
use App\Http\Requests\Admin\UpdateDoctorRequest;
use Illuminate\Http\Request;


class DoctorController extends BaseController
{
    public function __construct(Request $request) {
        parent::__construct($request);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $data = Doctor::orderBy('created_at', 'desc')->get();
        return view('admin.pages.doctor.index', compact('data'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */

    public function create()
    {
        $specialization = Specialization::all();
        $qualifications = DoctorQualificationConstants::QUALIFICATION;
        return view('admin.pages.doctor.create', compact('specialization', 'qualifications'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Admin\CreateDoctorRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateDoctorRequest $request)
    {
        $doctor = Doctor::create($request->only([ 'name', 'email', 'phone']));

        $doctor->specializations()->attach($request->specializations);

        foreach ($request->qualification as $qualification) {
            $doctor->qualifications()->create(['qualification' => $qualification]);
        }

        foreach ($request->file('image') as $image) {
            $fileName = $image->getClientOriginalName();
            $image->storeAs('image', $fileName, 'public');
            $doctor->images()->create(['image' => $fileName]);
        }

        return redirect()->route('admin.doctor.index')->with('success',"Doctor Created Successfully");

    }


    /**
     * Display the specified resource.
     *
     * @param \App\Models\Doctor $doctor
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show(Doctor $doctor)
    {
        $doctor->load('images', 'qualifications', 'specializations');
        $slots = Slot::where('doctor_id', $doctor->id)->whereDate('dates', '>=', now())->pluck('dates');
        $events = [];
        foreach ($slots as $slotDate) {
            $events[] = [
                'title' => 'Available',
                'start' => $slotDate,
            ];
        }
        $SlotEvents = json_encode($events);

        $doctorQualifications = $doctor->qualifications->pluck('qualification')->map(function ($qualificationId) {
            return DoctorQualificationConstants::QUALIFICATION[$qualificationId] ?? '';
        });

        return view('admin.pages.doctor.show', ['doctor' => $doctor, 'SlotEvents' => $SlotEvents, 'doctorQualifications' => $doctorQualifications]);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Doctor $doctor
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit(Doctor $doctor)
    {
        $specializations = Specialization::all();
        $images = DoctorImage::all();
        $qualifications = DoctorQualificationConstants::QUALIFICATION;
        return view('admin.pages.doctor.edit', ['doctor' => $doctor, 'specializations' => $specializations, 'qualifications' => $qualifications, 'images' => $images]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Admin\UpdateDoctorRequest $request
     * @param \App\Models\Doctor $doctor
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateDoctorRequest $request, Doctor $doctor)
    {
        $doctor->update($request->only(['name', 'email', 'phone']));

        $newSpecializationIds = $request->specializations;
        $doctor->specializations()->sync($newSpecializationIds);

        $doctor->qualifications()->delete();
        foreach ($request->qualification as $qualification) {
            $doctor->qualifications()->create(['qualification' => $qualification]);
        }

        if ($request->hasFile('image')) {
            $doctor->images()->delete();
            foreach ($request->file('image') as $image) {
                $fileName = $image->getClientOriginalName();
                $image->storeAs('image', $fileName, 'public');
                $doctor->images()->create(['image' => $fileName]);
            }
        }

        return redirect()->route('admin.doctor.show',['doctor'=>$doctor->id])->with('success',"Doctor Updated Successfully");
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Doctor $doctor
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Doctor $doctor)
    {
        if (!$doctor) {
            return redirect()->back()->with('success', "Doctor not found");
        }
        $doctor->qualifications()->delete();
        $doctor->specializations()->detach();
        Slot::where('doctor_id',$doctor->id)->delete();
        TimeSlot::where('doctor_id',$doctor->id)->delete();
        $doctor->delete();
        return redirect()->route('admin.doctor.index')->with('success', "Doctor deleted successfully");
    }

}
