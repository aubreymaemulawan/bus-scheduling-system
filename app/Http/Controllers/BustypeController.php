<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use App\Models\Bustype;

class BustypeController extends Controller
{
    public function list(Request $request){
        return json_encode(Bustype::all());
    }
    public function items(Request $request){
        return json_encode(Bustype::find($request->id));
    } 
    public function create(Request $request){
        $data = new Bustype();
        $data->bus_type = $request->bus_type;
        $data->save();
        return json_encode(
            ['success'=>true]
        );
    }
    public function update(Request $request){
        $data = Bustype::find($request->id);
        $data->bus_type = $request->bus_type;
        $data->save();
        return json_encode(
            ['success'=>true]
        );
    }
    public function delete(Request $request){
        $data = Bustype::find($request->id);
        $data->delete();
        return json_encode(
            ['success'=>true]
        );
    }
}
