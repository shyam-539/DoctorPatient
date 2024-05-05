<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\User\BaseController;
use Illuminate\Http\Request;


class HomeController extends BaseController
{
    public function __construct(Request $request) {
        parent::__construct($request);
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('user.home');
    }
}
