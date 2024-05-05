<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;


class HomeController extends BaseController
{
      /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function __construct(Request $request) {
        parent::__construct($request);
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index()
    // {
    //     return view('admin.home');
    // }
}
