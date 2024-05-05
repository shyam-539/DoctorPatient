<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Models\BookingRequest;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DashboardController extends BaseController
{
    public function __construct(Request $request) {
        parent::__construct($request);
    }


    /**
     * View of Admin dashboard
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function dashboard()
    {
        $newRequestCount = BookingRequest::where('status', 0)->count();
        $appoinmentCount = BookingRequest::where('status', 1)->count();
        $usersCount = User::count();
        $doctorsCount = Doctor::count();

        $monthlyRequestsCount = array_fill_keys(range(1, 12), 0);
        $monthlyAppointmentsCount = array_fill_keys(range(1, 12), 0);

        $requestsData = BookingRequest::select(DB::raw('MONTH(selected_date) as month'), DB::raw('COUNT(*) as count'))
            ->where('status', 0)
            ->groupBy(DB::raw('MONTH(selected_date)'))
            ->get();

        foreach ($requestsData as $data) {
            $monthlyRequestsCount[$data->month] = $data->count;
        }

        $appointmentsData = BookingRequest::select(DB::raw('MONTH(selected_date) as month'), DB::raw('COUNT(*) as count'))
            ->where('status', 1)
            ->groupBy(DB::raw('MONTH(selected_date)'))
            ->get();

        foreach ($appointmentsData as $data) {
            $monthlyAppointmentsCount[$data->month] = $data->count;
        }

        return view('admin.pages.dashboard', [
            'newRequestCount' => $newRequestCount,
            'appoinmentCount' => $appoinmentCount,
            'usersCount' => $usersCount,
            'doctorsCount' => $doctorsCount,
            'monthlyAppointmentsCount' => $monthlyAppointmentsCount,
            'monthlyRequestsCount' => $monthlyRequestsCount,
        ]);
    }





}
