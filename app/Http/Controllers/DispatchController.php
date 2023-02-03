<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Company;
use App\Models\Bus;
use App\Models\Operator;
use App\Models\Dispatcher;
use App\Models\Route;

class DispatchController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $schedule = Schedule::all();
        $company = Company::all();
        $bus = Bus::all();
        $operator = Operator::all();
        $dispatcher = Dispatcher::all();
        $route = Route::all();
        return view('dispatch.dashboard',compact('schedule','company','bus','operator','dispatcher','route'));
    }
}
