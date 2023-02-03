<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    public function list(Request $request){
        return json_encode(Schedule::with(['company','bus','operator','dispatcher','route'])->get());
    }
    public function items(Request $request){
        return json_encode(Schedule::with(['company','bus','operator','dispatcher','route'])->find($request->id));
    }
    public function create(Request $request){
        $request->validate([
            'date' => 'required',
            'company_id' => 'required',
            'bus_id' => 'required',
            'operator_id' => 'required',
            'dispatcher_id' => 'required' ,
            'route_id' => 'required' ,
            'first_trip' => 'required' ,
            'last_trip' => 'required' ,
            'interval_mins' => 'required' ,
            'max_trips' => 'required' ,
            'is_active' => 'required',
        ]);
        $bus_id = Schedule::where('date',$request->date)->get();
        $dispatcher_id = Schedule::where('date',$request->date)->get();
        $operator_id = Schedule::where('date',$request->date)->get();
        foreach($bus_id as $bs){
            if($bs->bus_id == $request->bus_id){
                return response()->json(1);
            }
        }
        foreach($operator_id as $op){
            if($op->operator_id == $request->operator_id){
                return response()->json(2);
            }
        }
        foreach($dispatcher_id as $dp){
            if($dp->dispatcher_id == $request->dispatcher_id){
                return response()->json(3);
            }
        }
        $data = new Schedule();
        $data->date = $request->date;
        $data->company_id = $request->company_id;
        $data->bus_id = $request->bus_id;
        $data->operator_id = $request->operator_id;
        $data->dispatcher_id = $request->dispatcher_id;
        $data->route_id = $request->route_id;
        $data->first_trip = $request->first_trip;
        $data->last_trip = $request->last_trip;
        $data->interval_mins = $request->interval_mins;
        $data->max_trips = $request->max_trips;
        $data->is_active = $request->is_active;
        $data->save();

        

        // $data1 = new Trip();
        // foreach()
        // $data1->schedule_id = $data->id;
        // $data1->trip_no = $data->id;
        return json_encode(
            ['success'=>true]
        );
    }
    public function update(Request $request){
        $request->validate([
            'date' => 'required',
            'company_id' => 'required',
            'bus_id' => 'required',
            'operator_id' => 'required',
            'dispatcher_id' => 'required' ,
            'route_id' => 'required' ,
            'first_trip' => 'required' ,
            'last_trip' => 'required' ,
            'interval_mins' => 'required' ,
            'max_trips' => 'required' ,
            'is_active' => 'required',
        ]);
        $bus_id = Schedule::where('date',$request->date)->get();
        $dispatcher_id = Schedule::where('date',$request->date)->get();
        $operator_id = Schedule::where('date',$request->date)->get();
        foreach($bus_id as $bs){
            if($bs->bus_id == $request->bus_id){
                if($bs->id != $request->id){
                    return response()->json(1);
                }
            }
        }
        foreach($operator_id as $op){
            if($op->operator_id == $request->operator_id){
                if($op->id != $request->id){
                    return response()->json(2);
                }            
            }
        }
        foreach($dispatcher_id as $dp){
            if($dp->dispatcher_id == $request->dispatcher_id){
                if($dp->id != $request->id){
                    return response()->json(3);
                }            
            }
        }
        $data = Schedule::find($request->id);
        $data->date = $request->date;
        $data->company_id = $request->company_id;
        $data->bus_id = $request->bus_id;
        $data->operator_id = $request->operator_id;
        $data->dispatcher_id = $request->dispatcher_id;
        $data->route_id = $request->route_id;
        $data->first_trip = $request->first_trip;
        $data->last_trip = $request->last_trip;
        $data->interval_mins = $request->interval_mins;
        $data->max_trips = $request->max_trips;
        $data->is_active = $request->is_active;
        $data->save();
        return json_encode(
            ['success'=>true]
        );
    }
    public function delete(Request $request){
        $data = Schedule::find($request->id);
        $data->delete();
        return json_encode(
            ['success'=>true]
        );
    }
    public function getBus(Request $request){
        $bus = \DB::table('bus')->where('company_id', $request->company_id)->get();
        if (count($bus) > 0) {
            return response()->json($bus);
        }
    } 
    public function getOperator(Request $request){
        $operator = \DB::table('operator')->where('company_id', $request->company_id)->get();
        if (count($operator) > 0) {
            return response()->json($operator);
        }
    }
    public function getDispatcher(Request $request){
        $dispatcher = \DB::table('dispatcher')->where('company_id', $request->company_id)->get();
        if (count($dispatcher) > 0) {
            return response()->json($dispatcher);
        }
    }
    public function scheduleGenerate(Request $request){
        $from = date($request->from);
        $to = date($request->to);
        if($request->company == 0 && $request->active == 0){
            $schedule = \DB::table('schedule')
            ->whereBetween('date', [$from, $to])
            ->get();
        }else if($request->active == 0){
            $schedule = \DB::table('schedule')
            ->where('company_id', '=', $request->company)
            ->whereBetween('date', [$from, $to])
            ->get();
        }else if($request->company == 0){
            $schedule = \DB::table('schedule')
            ->where('is_active', '=', $request->active)
            ->whereBetween('date', [$from, $to])
            ->get();
        }else{
            $schedule = \DB::table('schedule')
            ->where('is_active', '=', $request->active)
            ->where('company_id', '=', $request->company)
            ->whereBetween('date', [$from, $to])
            ->get();
        }
        if (count($schedule) > 0) {
            return response()->json($schedule);
        }else{
            return response()->json(0);
        }
    } 
    public function s(Request $request){
        $s = \DB::table('schedule')->get();
        $cnt = count($s);
        return json_encode($cnt);
    }

}
 