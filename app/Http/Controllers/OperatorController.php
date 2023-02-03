<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use App\Models\Operator;
 
class OperatorController extends Controller
{ 
    public function list(Request $request){
        return json_encode(Operator::with(['company'])->get());
    }
    public function items(Request $request){
        return json_encode(Operator::with(['company'])->find($request->id));
    }
    public function create(Request $request){
        $request->validate([
            'company_id' => 'required',
            'name' => 'required|unique:operator',
            'license_no' => 'required|unique:operator',
            'contact_no' => 'required',
            'age' => 'required',
            'address' => 'required',
            'profile_picture' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048' ,
        ]);
        $data = new Operator();
        $data->company_id = $request->company_id;
        $data->name = $request->name;
        $data->license_no = $request->license_no;
        $data->contact_no = $request->contact_no;
        $data->age = $request->age;
        $data->address = $request->address;
        $data->is_active = 1;
        if($request->hasFile('profile_picture')){
            $profile_name = $request->file('profile_picture')->getClientOriginalName();
            $profile_path = $request->file('profile_picture')->store('public/Profile_Images');
            $data->profile_name = $profile_name;
            $data->profile_path = $profile_path;
        }
        $data->save();
        return json_encode(
            ['success'=>true]
        );
    }
    public function update(Request $request){
        $request->validate([
            'edit-company_id' => 'required',
            'edit-name' => 'required',
            'edit-contact_no' => 'required',
            'edit-license_no' => 'required',
            'edit-age' => 'required',
            'edit-address' => 'required',
            'edit-is_active' => 'required' ,
            'edit-profile_picture' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048' ,
        ]);
        $data = Operator::find($request->input("edit-id"));
        $data->company_id = $request->input("edit-company_id");
        $data->name = $request->input("edit-name");
        $data->contact_no = $request->input("edit-contact_no");
        $data->license_no = $request->input("edit-license_no");
        $data->age = $request->input("edit-age");
        $data->address = $request->input("edit-address");
        $data->is_active = $request->input("edit-is_active");
        if($request->hasFile('edit-profile_picture')){
            $profile_name = $request->file('edit-profile_picture')->getClientOriginalName();
            $profile_path = $request->file('edit-profile_picture')->store('public/Profile_Images');
            $data->profile_name = $profile_name;
            $data->profile_path = $profile_path;
        }
        $data->save();
        return json_encode(
            ['success'=>true]
        );
    }
    public function delete(Request $request){
        $data = Operator::find($request->id);
        $data->delete();
        return json_encode(
            ['success'=>true]
        );
    }
    public function operatorGenerate(Request $request){
        $from = date($request->from);
        $to = date($request->to);
        if($request->company == 0 && $request->active == 0){
            $operator = \DB::table('operator')
            ->whereBetween('created_at', [$from, $to])
            ->get();
        }else if($request->active == 0){
            $operator = \DB::table('operator')
            ->where('company_id', '=', $request->company)
            ->whereBetween('created_at', [$from, $to])
            ->get();
        }else if($request->company == 0){
            $operator = \DB::table('operator')
            ->where('is_active', '=', $request->active)
            ->whereBetween('created_at', [$from, $to])
            ->get();
        }else{
            $operator = \DB::table('operator')
            ->where('is_active', '=', $request->active)
            ->where('company_id', '=', $request->company)
            ->whereBetween('created_at', [$from, $to])
            ->get();
        }
        if (count($operator) > 0) {
            return response()->json($operator);
        }else{
            return response()->json(0);
        }
    } 
}
