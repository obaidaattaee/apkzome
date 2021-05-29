<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use PragmaRX\Tracker\Tracker;

/**
 * Class AdminBaseController
 * @package App\Http\Controllers\Admin
 */
class AdminBaseController extends Controller
{

    /**
     * @return View
     */
    public function index(): View
    {
        $visitor = \Tracker::currentSession();
        $sessions = \Tracker::sessions(60 * 24);
        return view('layouts.admin');
    }
}
