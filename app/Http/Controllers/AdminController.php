<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Bus;
use App\Models\Operator;
use App\Models\Dispatcher;
use App\Models\Transaction;


class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $schedule = Schedule::all();
        $bus = Bus::all();
        $operator = Operator::all();
        $dispatcher = Dispatcher::all();
        $transaction = Transaction::all();
        return view('admin.dashboard',compact('schedule','bus','operator','dispatcher','transaction'));
    }



}
