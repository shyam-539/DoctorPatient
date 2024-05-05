<?php
/**
 * Created By - Adithya Prasad
 * Date - 27/02/2024
*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;


class LayoutController extends Controller
{
    /**
     * layout for admin
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function adminIndex(){
        return view('layouts.admin-index');
    }


    /**
     * layout for user
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function userIndex(){
        return view('layouts.user-index');
    }

    /**
     * layout to admin view slot
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function adminSlotIndex(){
        return view('layouts.admin-slotView-index');
    }
}
