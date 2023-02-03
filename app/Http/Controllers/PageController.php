<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Bus;
use App\Models\Company;
use App\Models\Daccount;
use App\Models\Discount;
use App\Models\Dispatcher;
use App\Models\Fare;
use App\Models\Location;
use App\Models\Operator;
use App\Models\Route;
use App\Models\Schedule;
use App\Models\Status;
use App\Models\Transaction;
use App\Models\Trip;
use App\Models\Busstatus;
use App\Models\Bustype;
use App\Models\StatusTrip;
use App\Models\User;
use PDF;


class PageController extends Controller
{
    // public function dashboard(){
    //     return view('dashboard');
    // }


    // Admin Views
    public function bus(){
        $bus = Bus::all();
        $company = Company::all();
        $bustype = Bustype::all();
        return view('admin.bus',compact('bus','company','bustype'));
    }
    public function bustype(){
        $data = Bustype::all();
        return view('admin.bustype',compact('data'));
    }
    public function company(){
        $data = Company::all();
        return view('admin.company',compact('data'));
    }
    public function location(){
        $data = Location::all();
        return view('admin.location',compact('data'));
    }
    public function route(){
        $data = Route::all();
        return view('admin.route',compact('data'));
    }
    public function dispatcher(){
        $dispatcher = Dispatcher::all();
        $company = Company::all();
        return view('admin.dispatcher',compact('dispatcher','company'));
    }
    public function daccount(){
        $daccount = Daccount::all();
        $company = Company::all();
        $dispatcher = Dispatcher::all();
        return view('admin.daccount',compact('daccount','dispatcher','company'));
    }
    public function operator(){
        $operator = Operator::all();
        $company = Company::all();
        return view('admin.operator',compact('operator','company'));
    }
    public function fare(){
        $fare = Fare::all();
        $route = Route::all();
        $bustype = Bustype::all();
        return view('admin.fare',compact('fare','route','bustype'));
    }
    public function schedule(){
        $schedule = Schedule::all();
        $company = Company::all();
        $bus = Bus::all();
        $operator = Operator::all();
        $dispatcher = Dispatcher::all();
        $route = Route::all();
        return view('admin.schedule',compact('schedule','company','bus','operator','dispatcher','route'));
    }
    public function transaction(){
        $transaction = Transaction::all();
        $fare = Fare::all();
        $discount = Discount::all();
        return view('admin.transaction',compact('transaction','fare','discount'));
    }
    public function trip(){
        $trip = Trip::all();
        $schedule = Schedule::all();
        return view('admin.trip',compact('trip','schedule'));
    }

    // Dispatch Views
    public function dispatch_schedule(){
        $schedule = Schedule::all();
        $company = Company::all();
        $bus = Bus::all();
        $operator = Operator::all();
        $dispatcher = Dispatcher::all();
        $route = Route::all();
        return view('dispatch.schedule',compact('schedule','company','bus','operator','dispatcher','route'));
    }
    public function dispatch_transaction(){
        $transaction = Transaction::all();
        $fare = Fare::all();
        $discount = Discount::all();
        $busstatus = Busstatus::all();
        $status = Status::all();
        $dispatcher = Dispatcher::all();
        return view('dispatch.transaction',compact('transaction','fare','discount','busstatus','status','dispatcher'));
    }
    public function dispatch_trip(){
        // Trip
        $trip = Trip::all();
        $schedule = Schedule::all();
        // Status
        $status = Status::all();
        $busstatus = busstatus::all();
        // Status_Trip
        $status_trip = StatusTrip::all();
        $dispatcher = Dispatcher::all();
        return view('dispatch.trip',compact('trip','schedule','status','busstatus','status_trip','dispatcher'));
    }




    // public function busstatus(){
    //     $data = Busstatus::all();
    //     return view('admin.busstatus',compact('data'));
    // }
    // public function status(){
    //     $status = Status::all();
    //     $busstatus = busstatus::all();
    //     return view('status',compact('status','bustatus'));
    // }
    // public function discount(){
    //     $data = Discount::all();
    //     return view('discount',compact('data'));
    // }
    // public function user(){
    //     $data = User::all();
    //     return view('user',compact('data'));
    // }

    // public function schedule_transaction(){
    //     $schedule_transaction = ScheduleTransaction::all();
    //     $schedule = Schedule::all();
    //     $transaction = Transaction::all();
    //     return view('schedule_transaction',compact('schedule_transaction','schedule','transaction'));
    // }

    // public function status_trip(){
    //     $status_trip = StatusTrip::all();
    //     $status = Status::all();
    //     $trip = Trip::all();
    //     return view('status_trip',compact('status_trip','status','trip'));
    // }



    // Reports Views
    public function reportbus(){
        $bus = Bus::all();
        $company = Company::all();
        $bustype = Bustype::all();
        return view('admin.reports.reportbus',compact('bus','company','bustype'));
    }
    public function reportcompany(){
        $data = Company::all();
        return view('admin.reports.reportcompany',compact('data'));
    }
    public function reportdispatcher(){
        $dispatcher = Dispatcher::all();
        $company = Company::all();
        return view('admin.reports.reportdispatcher',compact('dispatcher','company'));
    }
    public function reportoperator(){
        $operator = Operator::all();
        $company = Company::all();
        return view('admin.reports.reportoperator',compact('operator','company'));
    }
    public function reportschedule(){
        $schedule = Schedule::all();
        $company = Company::all();
        $bus = Bus::all();
        $operator = Operator::all();
        $dispatcher = Dispatcher::all();
        $route = Route::all();
        return view('admin.reports.reportschedule',compact('schedule','company','bus','operator','dispatcher','route'));
    }
    public function reportfare(){
        $fare = Fare::all();
        $route = Route::all();
        $bustype = Bustype::all();
        return view('admin.reports.reportfare',compact('fare','route','bustype'));
    }
    public function reporttransaction(){
        $transaction = Transaction::all();
        $fare = Fare::all();
        $discount = Discount::all();
        return view('admin.reports.reporttransaction',compact('transaction','fare','discount'));
    }
}
 