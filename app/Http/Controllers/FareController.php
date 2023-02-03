<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use App\Models\Fare;

class FareController extends Controller
{
    public function list(Request $request){
        return json_encode(Fare::with(['route','bustype'])->get());
    }
    public function items(Request $request){
        return json_encode(Fare::with(['route','bustype'])->find($request->id));
    }
    public function create(Request $request){
        $request->validate([
            'route_id' => 'required',
            'bustype_id' => 'required',
            'price' => 'required',
        ]);
        $route_id = Fare::where('bustype_id',$request->bustype_id)->get();
        foreach($route_id as $rd){
            if($rd->route_id == $request->route_id){
                return response()->json(1);
            }
        }
        $data = new Fare();
        $data->route_id = $request->route_id;
        $data->bustype_id = $request->bustype_id;
        $data->price = $request->price;
        $data->save();
        return json_encode(
            ['success'=>true]
        );
    }
    public function update(Request $request){
        $request->validate([
            'route_id' => 'required',
            'bustype_id' => 'required',
            'price' => 'required',
        ]);
        $route_id = Fare::where('bustype_id',$request->bustype_id)->get();
        foreach($route_id as $rd){
            if($rd->route_id == $request->route_id){
                if($rd->id != $request->id){
                    return response()->json(1);
                }
            }
        }
        $data = Fare::find($request->id);
        $data->route_id = $request->route_id;
        $data->bustype_id = $request->bustype_id;
        $data->price = $request->price;
        $data->save();
        return json_encode(
            ['success'=>true]
        );
    }
    public function delete(Request $request){
        $data = Fare::find($request->id);
        $data->delete();
        return json_encode(
            ['success'=>true]
        );
    }
    public function fareGenerate(Request $request){
        $from = date($request->from);
        $to = date($request->to);
        if($request->bustype == 0){
            $fare = \DB::table('fare')
            ->whereBetween('created_at', [$from, $to])
            ->get();
        }else{
            $fare = \DB::table('fare')
            ->where('bustype_id', '=', $request->bustype)
            ->whereBetween('created_at', [$from, $to])
            ->get();
        }
        if (count($fare) > 0) {
            return response()->json($fare);
        }else{
            return response()->json(0);
        }
    }
}
