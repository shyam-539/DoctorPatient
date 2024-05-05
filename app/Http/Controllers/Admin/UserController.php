<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Admin\BaseController;
use App\Models\User;
use Illuminate\Http\Request;


class UserController extends BaseController
{
    public function __construct(Request $request) {
        parent::__construct($request);
    }


    /**
     * View User
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function users()
    {
        $user= User::all();
        return view('admin.pages.user.view-users',compact('user'));
    }
}
