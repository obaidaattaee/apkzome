<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

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
        return view('layouts.admin');
    }
}
