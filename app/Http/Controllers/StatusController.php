<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use App\Models\Status;

class StatusController extends Controller
{
    public function list(Request $request){
        return json_encode(Status::with(['busstatus'])->get());
    }
    public function items(Request $request){
        return json_encode(Status::with(['busstatus'])->find($request->id));
    }
    public function create(Request $request){
        $data = new Status();
        $data->busstatus_id = $request->busstatus_id;
        $data->current_location = $request->current_location;
        $data->save();
        return json_encode(
            ['success'=>true]
        );
    }
    public function update(Request $request){
        $data = Status::find($request->id);
        $data->busstatus_id = $request->busstatus_id;
        $data->current_location = $request->current_location;
        $data->save();
        return json_encode(
            ['success'=>true]
        );
    }
    public function delete(Request $request){
        $data = Status::find($request->id);
        $data->delete();
        return json_encode(
            ['success'=>true]
        );
    }
}
