<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\User\BaseController;
use App\Models\BookingRequest;
use App\Models\Specialization;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardController extends BaseController
{
    public function __construct(Request $request) {
        parent::__construct($request);
    }


    /**
     * View of User dashboard
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function dashboard()
    {
        $user = Auth::user();
        $today = Carbon::today()->toDateString();

        $newRequestCount = BookingRequest::where('status', 0) ->where('user_id', $user->id)->count();
        $appoinmentCount = BookingRequest::where('status', 1) ->where('user_id', $user->id)->count();
        $consultationCount = BookingRequest::where('status', 1)->where('user_id', $user->id)->whereDate('selected_date', '<', $today) ->count();
        $cancelCount = BookingRequest::where('status', 2)->where('user_id', $user->id)->count();

        $specializationCount = Specialization::all()->count();
        $Specialization = Specialization::all();

        return view('user.pages.dashboard',['newRequestCount'=>$newRequestCount,'appoinmentCount'=>$appoinmentCount,'consultationCount'=>$consultationCount,
                    'cancelCount'=>$cancelCount,'specializationCount'=>$specializationCount, 'Specialization'=>$Specialization]);
    }



}
