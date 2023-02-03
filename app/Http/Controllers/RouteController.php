<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use App\Models\Route;

class RouteController extends Controller
{
    public function list(Request $request){
        return json_encode(Route::all());
    }
    public function items(Request $request){
        return json_encode(Route::find($request->id));
    }
    public function create(Request $request){
        $request->validate([ 
            'from_to_location' => 'required|unique:route',
        ]);
        $data = new Route();        
        $data->from_to_location = $request->from_to_location;
        $data->save();
        return json_encode(
            ['success'=>true]
        );
    }
    public function update(Request $request){
        $request->validate([ 
            'from_to_location' => 'required',
        ],);
        $data = Route::find($request->id);
        $data->from_to_location = $request->from_to_location;
        $data->save();
        return json_encode(
            ['success'=>true]
        );
    }
    public function delete(Request $request){
        $data = Route::find($request->id);
        $data->delete();
        return json_encode(
            ['success'=>true]
        );
    }
}
