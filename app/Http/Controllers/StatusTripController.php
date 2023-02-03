<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use App\Models\StatusTrip;

class StatusTripController extends Controller
{
    public function list(Request $request){
        return json_encode(StatusTrip::with(['status','trip'])->get());
    }
    public function items(Request $request){
        return json_encode(StatusTrip::with(['status','trip'])->find($request->id));
    }
    public function create(Request $request){
        $data = new StatusTrip();
        $data->status_id = $request->status_id;
        $data->trip_id = $request->trip_id;
        $data->trip_duration = $request->trip_duration;
        $data->is_active = $request->is_active;
        $data->save();
        return json_encode(
            ['success'=>true]
        );
    }
    public function update(Request $request){
        $data = StatusTrip::find($request->id);
        $data->status_id = $request->status_id;
        $data->trip_id = $request->trip_id;
        $data->trip_duration = $request->trip_duration;
        $data->is_active = $request->is_active;
        $data->save();
        return json_encode(
            ['success'=>true]
        );
    }
    public function delete(Request $request){
        $data = StatusTrip::find($request->id);
        $data->delete();
        return json_encode(
            ['success'=>true]
        );
    }
}
