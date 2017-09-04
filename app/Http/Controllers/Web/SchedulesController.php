<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class SchedulesController extends Controller
{

    /**
     * Share code
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function share()
    {
        return view('schedule.share');
    }

}
