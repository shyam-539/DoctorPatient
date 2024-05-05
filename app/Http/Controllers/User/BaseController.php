<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;


class BaseController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct(Request $request) {
        parent::__construct($request);
        $this->middleware('auth:user');
    }

}
