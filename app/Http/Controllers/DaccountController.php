<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use App\Models\Daccount;

class DaccountController extends Controller
{
    public function list(Request $request){
        return json_encode(Daccount::with(['company','dispatcher'])->get());
    }
    public function items(Request $request){
        return json_encode(Daccount::with(['company','dispatcher'])->find($request->id));
    }
    public function create(Request $request){
        $request->validate([
            'dispatcher_id' => 'required|unique:daccount',
            'email' => 'required|unique:daccount|unique:users',
            'password' => 'required',
        ]);
        $data = new Daccount();
        $data->dispatcher_id = $request->dispatcher_id;
        $data->email = $request->email;
        $data->password = $request->password;
        $data->save();
        return json_encode(
            ['success'=>true]
        );
    } 
    public function update(Request $request){
        $request->validate([
            'dispatcher_id' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        $data = Daccount::find($request->id);
        $data->dispatcher_id = $request->dispatcher_id;
        $data->email = $request->email;
        $data->password = $request->password;
        $data->save();
        return json_encode(
            ['success'=>true]
        );
    }
    public function getDispatcher(Request $request){
        $dispatcher = \DB::table('dispatcher')->where('company_id', $request->company_id)->get();
        if (count($dispatcher) > 0) {
            return response()->json($dispatcher);
        }
    }
} 
