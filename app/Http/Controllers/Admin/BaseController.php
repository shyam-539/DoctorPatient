<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;


class BaseController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct(Request $request) {
        parent::__construct($request);
        $this->middleware('auth:admin');
    }

}
