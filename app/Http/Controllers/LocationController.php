<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use App\Models\Location;

class LocationController extends Controller
{
    public function list(Request $request){
        return json_encode(Location::all());
    }
    public function items(Request $request){
        return json_encode(Location::find($request->id));
    }
    public function create(Request $request){
        $request->validate([ 
            'place' => 'required|unique:location'
        ]);
        $data = new Location();
        $data->place = $request->place;
        $data->save();
        return json_encode(
            ['success'=>true]
        );
    }
    public function update(Request $request){
        $request->validate([ 
            'place' => 'required'
        ]);
        $data = Location::find($request->id);
        $data->place = $request->place;
        $data->save();
        return json_encode(
            ['success'=>true]
        );
    }
    public function delete(Request $request){
        $data = Location::find($request->id);
        $data->delete();
        return json_encode(
            ['success'=>true]
        );
    }
}
