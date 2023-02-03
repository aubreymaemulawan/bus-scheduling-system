<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use App\Models\Busstatus;

class BusstatusController extends Controller
{
    public function list(Request $request){
        return json_encode(Busstatus::all());
    }
    public function items(Request $request){
        return json_encode(Busstatus::find($request->id));
    } 
    public function create(Request $request){
        $data = new Busstatus();
        $data->bus_status = $request->bus_status;
        $data->save();
        return json_encode(
            ['success'=>true]
        );
    }
    public function update(Request $request){
        $data = Busstatus::find($request->id);
        $data->bus_status = $request->bus_status;
        $data->save();
        return json_encode(
            ['success'=>true]
        );
    }
    public function delete(Request $request){
        $data = Busstatus::find($request->id);
        $data->delete();
        return json_encode(
            ['success'=>true]
        );
    }
}
