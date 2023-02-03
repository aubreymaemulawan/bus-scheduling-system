<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use App\Models\Dispatcher;
use App\Models\Daccount; 
use App\Models\User;
use DB;

class DispatcherController extends Controller
{
    public function list(Request $request){
        return json_encode(Dispatcher::with(['company'])->get());
    }
    public function items(Request $request){
        return json_encode(Dispatcher::with(['company'])->find($request->id));
    }
    public function create(Request $request){
        $request->validate([
            'company_id' => 'required',
            'name' => 'required|unique:dispatcher',
            'contact_no' => 'required',
            'age' => 'required',
            'address' => 'required',
            'profile_picture' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048' ,
        ]);
        $data = new Dispatcher();
        $data->company_id = $request->company_id;
        $data->name = $request->name;
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
            'edit-age' => 'required',
            'edit-address' => 'required',
            'edit-is_active' => 'required' ,
            'edit-profile_picture' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048' ,
        ]);
        $data = Dispatcher::find($request->input("edit-id"));
        $data->company_id = $request->input("edit-company_id");
        $data->name = $request->input("edit-name");
        $data->contact_no = $request->input("edit-contact_no");
        $data->age = $request->input("edit-age");
        $data->address = $request->input("edit-address");
        $data->is_active = $request->input("edit-is_active");
        $data1 = Daccount::where('dispatcher_id',$request->input("edit-id"))->get();
        $data2 = User::where('dispatcher_id',$request->input("edit-id"))->get();
        $email = Daccount::where('dispatcher_id',$request->input("edit-id"))->value('email');
        $password = Daccount::where('dispatcher_id',$request->input("edit-id"))->value('password');

        if($request->input("edit-is_active") == 2){
            $user_delete = User::where('dispatcher_id',$request->input("edit-id"));
            $user_delete->delete();
        }else if($request->input("edit-is_active") == 1 && count($data1) != 0 && count($data2) == 0){
            $data2 = new User();
            $data2->name = $request->input("edit-name");
            $data2->dispatcher_id = $request->input("edit-id");
            $data2->email = $email;
            $data2->password = bcrypt($password);
            $data2->userType = "dispatch";
            $data2->save();
        }
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
        $data = Dispatcher::find($request->id);
        $data->delete();
        return json_encode(
            ['success'=>true]
        );
    }
    public function dispatcherGenerate(Request $request){
        $from = date($request->from);
        $to = date($request->to);
        if($request->company == 0 && $request->active == 0){
            $dispatcher = \DB::table('dispatcher')
            ->whereBetween('created_at', [$from, $to])
            ->get();
        }else if($request->active == 0){
            $dispatcher = \DB::table('dispatcher')
            ->where('company_id', '=', $request->company)
            ->whereBetween('created_at', [$from, $to])
            ->get();
        }else if($request->company == 0){
            $dispatcher = \DB::table('dispatcher')
            ->where('is_active', '=', $request->active)
            ->whereBetween('created_at', [$from, $to])
            ->get();
        }else{
            $dispatcher = \DB::table('dispatcher')
            ->where('is_active', '=', $request->active)
            ->where('company_id', '=', $request->company)
            ->whereBetween('created_at', [$from, $to])
            ->get();
        }
        if (count($dispatcher) > 0) {
            return response()->json($dispatcher);
        }else{
            return response()->json(0);
        }
    } 
}
 