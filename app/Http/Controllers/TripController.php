<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use App\Models\Trip;

class TripController extends Controller
{
    public function list(Request $request){
        return json_encode(Trip::with(['schedule'])->get());
    }
    public function items(Request $request){
        return json_encode(Trip::with(['schedule'])->find($request->id));
    }
    public function create(Request $request){
        $data = new Trip();
        $data->schedule_id = $request->schedule_id;
        $data->trip_no = $request->trip_no;
        $data->save();
        return json_encode(
            ['success'=>true]
        );
    }
    public function update(Request $request){
        $data = Trip::find($request->id);
        $data->schedule_id = $request->schedule_id;
        $data->trip_no = $request->trip_no;
        $data->save();
        return json_encode(
            ['success'=>true]
        );
    }
    public function delete(Request $request){
        $data = Trip::find($request->id);
        $data->delete();
        return json_encode(
            ['success'=>true]
        );
    }
}
