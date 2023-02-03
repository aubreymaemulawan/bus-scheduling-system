<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use App\Models\Bus;

class BusController extends Controller
{
    public function list(Request $request){
        return json_encode(Bus::with(['company','bustype'])->get());
    }
    public function items(Request $request){
        return json_encode(Bus::with(['company','bustype'])->find($request->id));
    }
    public function create(Request $request){
        $request->validate([
            'company_id' => 'required',
            'bustype_id' => 'required',
            'bus_no' => 'required|unique:bus',
            'plate_no' => 'required|unique:bus' ,
            'chassis_no' => 'required|unique:bus' ,
            'engine_no' => 'required|unique:bus' ,
            'is_active' => 'required',
        ]);
        $data = new Bus();
        $data->company_id = $request->company_id;
        $data->bustype_id = $request->bustype_id;
        $data->bus_no = $request->bus_no;
        $data->plate_no = $request->plate_no;
        $data->chassis_no = $request->chassis_no;
        $data->engine_no = $request->engine_no;
        $data->is_active = $request->is_active;
        $data->save();
        return json_encode(
            ['success'=>true]
        );
    } 
    public function update(Request $request){
        $request->validate([
            'company_id' => 'required',
            'bustype_id' => 'required',
            'bus_no' => 'required',
            'plate_no' => 'required' ,
            'chassis_no' => 'required' ,
            'engine_no' => 'required' ,
            'is_active' => 'required',
        ]);
        $data = Bus::find($request->id);
        $data->company_id = $request->company_id;
        $data->bustype_id = $request->bustype_id;
        $data->bus_no = $request->bus_no;
        $data->plate_no = $request->plate_no;
        $data->chassis_no = $request->chassis_no;
        $data->engine_no = $request->engine_no;
        $data->is_active = $request->is_active;
        $data->save();
        return json_encode(
            ['success'=>true]
        );
    }
    public function delete(Request $request){
        $data = Bus::find($request->id);
        $data->delete();
        return json_encode(
            ['success'=>true]
        );
    }
    public function busGenerate(Request $request){
        $from = date($request->from);
        $to = date($request->to);
        if($request->company == 0 && $request->active == 0){
            $bus = \DB::table('bus')
            ->whereBetween('created_at', [$from, $to])
            ->get();
        }else if($request->active == 0){
            $bus = \DB::table('bus')
            ->where('company_id', '=', $request->company)
            ->whereBetween('created_at', [$from, $to])
            ->get();
        }else if($request->company == 0){
            $bus = \DB::table('bus')
            ->where('is_active', '=', $request->active)
            ->whereBetween('created_at', [$from, $to])
            ->get();
        }else{
            $bus = \DB::table('bus')
            ->where('is_active', '=', $request->active)
            ->where('company_id', '=', $request->company)
            ->whereBetween('created_at', [$from, $to])
            ->get();
        }
        if (count($bus) > 0) {
            return response()->json($bus);
        }else{
            return response()->json(0);
        }
    } 
    
}
