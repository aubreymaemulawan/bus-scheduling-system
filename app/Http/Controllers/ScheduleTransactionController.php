<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use App\Models\ScheduleTransaction;

class ScheduleTransactionController extends Controller
{
    public function list(Request $request){
        return json_encode(ScheduleTransaction::with(['schedule','transaction'])->get());
    }
    public function items(Request $request){
        return json_encode(ScheduleTransaction::with(['schedule','transaction'])->find($request->id));
    }
    public function create(Request $request){
        $data = new ScheduleTransaction();
        $data->schedule_id = $request->schedule_id;
        $data->transaction_id = $request->transaction_id;
        $data->total_passengers = $request->total_passengers;
        $data->total_amount = $request->total_amount;
        $data->save();
        return json_encode(
            ['success'=>true]
        );
    }
    public function update(Request $request){
        $data = ScheduleTransaction::find($request->id);
        $data->schedule_id = $request->schedule_id;
        $data->transaction_id = $request->transaction_id;
        $data->total_passengers = $request->total_passengers;
        $data->total_amount = $request->total_amount;
        $data->save();
        return json_encode(
            ['success'=>true]
        );
    }
    public function delete(Request $request){
        $data = ScheduleTransaction::find($request->id);
        $data->delete();
        return json_encode(
            ['success'=>true]
        );
    }
}
