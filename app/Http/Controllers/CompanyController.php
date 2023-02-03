<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use App\Models\Company;
use App\Models\Bus;
use App\Models\User;
use App\Models\Operator;
use App\Models\Dispatcher;
use App\Models\Daccount;

class CompanyController extends Controller
{
    public function list(Request $request){
        return json_encode(Company::all());
    }
    public function items(Request $request){
        return json_encode(Company::find($request->id));
    } 
    public function create(Request $request){
        $request->validate([
            'company_name' => 'required|unique:company',
            'address' => 'required',
            'description' => 'required',
            'logo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048' ,
        ]);
        $data = new Company();
        $data->company_name = $request->company_name;
        $data->address = $request->address;
        $data->description = $request->description;
        $data->is_active = 1;
        if($request->hasFile('logo')){
            $logo_name = $request->file('logo')->getClientOriginalName();
            $logo_path = $request->file('logo')->store('public/Images');
            $data->logo_name = $logo_name;
            $data->logo_path = $logo_path;
        }
        $data->save();
        return json_encode(
            ['success'=>true]
        );
    }
    public function update(Request $request){
        $request->validate([
            'edit-company_name' => 'required',
            'edit-address' => 'required',
            'edit-description' => 'required',
            'edit-is_active' => 'required' ,
            'edit-logo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048' ,
        ]);
        $data = Company::find($request->input("edit-id"));
        $data->company_name = $request->input("edit-company_name");
        $data->address = $request->input("edit-address");
        $data->description = $request->input("edit-description");
        $data->is_active = $request->input("edit-is_active");
        if($request->input("edit-is_active")==2){
            // If Company changes status to Inactive, Bus will be Inactive also
            $bus = Bus::where('company_id',$request->input("edit-id"))->get();
            foreach($bus as $bs){
                $bs->is_active = 2;
                $bs->save();
            }
            // If Company changes status to Inactive, Dispatcher will be Inactive also
            $dispatcher = Dispatcher::where('company_id',$request->input("edit-id"))->get();
            foreach($dispatcher as $dp){
                $dp->is_active = 2;
                $dp->save();
                $user_delete = User::where('dispatcher_id',$dp->id);
                $user_delete->delete();
            }
            // If Company changes status to Inactive, Operator will be Inactive also
            $operator = Operator::where('company_id',$request->input("edit-id"))->get();
            foreach($operator as $op){
                $op->is_active = 2;
                $op->save();
            }
        }else if($request->input("edit-is_active")==1){
            // If Company changes status to Active, Bus will be Active also
            $bus = Bus::where('company_id',$request->input("edit-id"))->get();
            foreach($bus as $bs){
                $bs->is_active = 1;
                $bs->save();
            }
            // If Company changes status to Active, Dispatcher will be Active also
            $dispatcher = Dispatcher::where('company_id',$request->input("edit-id"))->get();
            foreach($dispatcher as $dp){
                $dp->is_active = 1;
                $dp->save();

                $data1 = Daccount::where('dispatcher_id',$dp->id)->get();
                $email = Daccount::where('dispatcher_id',$dp->id)->value('email');
                $password = Daccount::where('dispatcher_id',$dp->id)->value('password');
                
                if(count($data1) != 0){
                    $data2 = new User();
                    $data2->name = $dp->name;
                    $data2->dispatcher_id = $dp->id;
                    $data2->email = $email;
                    $data2->password = bcrypt($password);
                    $data2->userType = "dispatch";
                    $data2->save();
                }
            }
            // If Company changes status to Active, Operator will be Active also
            $operator = Operator::where('company_id',$request->input("edit-id"))->get();
            foreach($operator as $op){
                $op->is_active = 1;
                $op->save();
            }
        }
        if($request->hasFile('edit-logo')){
            $logo_name = $request->file('edit-logo')->getClientOriginalName();
            $logo_path = $request->file('edit-logo')->store('public/Images');
            $data->logo_name = $logo_name;
            $data->logo_path = $logo_path;
        }
        $data->save();
        return json_encode(
            ['success'=>true]
        ); 
    }
    public function delete(Request $request){
        $data = Company::find($request->id);
        $data->delete();
        return json_encode(
            ['success'=>true]
        );
    }
    public function companyGenerate(Request $request){
        $from = date($request->from);
        $to = date($request->to);
        if($request->active == 0){
            $company = \DB::table('company')
            ->whereBetween('created_at', [$from, $to])
            ->get();
        }else{
            $company = \DB::table('company')
            ->where('is_active', '=', $request->active)
            ->whereBetween('created_at', [$from, $to])
            ->get();
        }
        if (count($company) > 0) {
            return response()->json($company);
        }else{
            return response()->json(0);
        }
    }
}
