<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function list(Request $request){
        return json_encode(Transaction::with(['fare','discount'])->get());
    }
    public function items(Request $request){
        return json_encode(Transaction::with(['fare','discount'])->find($request->id));
    }
    public function create(Request $request){
        $data = new Transaction();
        $data->fare_id = $request->fare_id;
        $data->discount_id = $request->discount_id;
        $data->no_passenger = $request->no_passenger;
        $data->amount = $request->amount;
        $data->save();
        return json_encode(
            ['success'=>true]
        );
    }
    public function update(Request $request){
        $data = Transaction::find($request->id);
        $data->fare_id = $request->fare_id;
        $data->discount_id = $request->discount_id;
        $data->no_passenger = $request->no_passenger;
        $data->amount = $request->amount;
        $data->save();
        return json_encode(
            ['success'=>true]
        );
    }
    public function delete(Request $request){
        $data = Transaction::find($request->id);
        $data->delete();
        return json_encode(
            ['success'=>true]
        );
    }
    public function transactionGenerate(Request $request){
        $from = date($request->from);
        $to = date($request->to);
        if($request->company == 0 && $request->active == 0){
            $transaction = \DB::table('transaction')
            ->whereBetween('created_at', [$from, $to])
            ->get();
        }else if($request->active == 0){
            $transaction = \DB::table('transaction')
            ->where('company_id', '=', $request->company)
            ->whereBetween('created_at', [$from, $to])
            ->get();
        }else if($request->company == 0){
            $transaction = \DB::table('transaction')
            ->where('is_active', '=', $request->active)
            ->whereBetween('created_at', [$from, $to])
            ->get();
        }else{
            $transaction = \DB::table('transaction')
            ->where('is_active', '=', $request->active)
            ->where('company_id', '=', $request->company)
            ->whereBetween('created_at', [$from, $to])
            ->get();
        }
        if (count($transaction) > 0) {
            return response()->json($transaction);
        }else{
            return response()->json(0);
        }
    } 
}
