<?php
/**
 * Created By - Adithya Prasad
 * Date - 28/02/2024
*/
namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\Admin\CreateSpecializationRequest;
use App\Models\Specialization;
use Illuminate\Http\Request;


class SpecializationController extends BaseController
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
        $data = Specialization::all();
        return view('admin.pages.specialization.index',compact('data'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        return view('admin.pages.specialization.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param CreateSpecializationRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateSpecializationRequest $request)
    {
        $existingSpecialization = Specialization::where('specialization', $request->specialization)->first();
        if ($existingSpecialization) {
            return redirect()->back()->with('error', "Specialization ". $existingSpecialization->specialization ." already exists.");
        }

        Specialization::create($request->all());
        return redirect()->route('admin.specialization.index')->with('success', "Specialization created successfully");
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Specialization $specialization
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit(Specialization $specialization)
    {
        return view('admin.pages.specialization.edit', ['specialization' => $specialization]);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Specialization $specialization
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Specialization $specialization)
    {
        $specialization->update($request->only(['specialization']));
        return redirect()->route('admin.specialization.index')->with('success',"Specialization Updated Sucessfully");

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Specialization $specialization
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, Specialization $specialization)
    {
        if ($request->ajax()) {
            if ($specialization) {
                $specialization->delete();
                return response()->json(['success' => 'Specialization deleted successfully']);
            }
            return response()->json(['error' => 'Specialization not found'], 404);
        }
        return abort(404);
    }

}
