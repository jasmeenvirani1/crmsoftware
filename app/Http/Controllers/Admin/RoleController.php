<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('admin.roles.index', ['title' => "Role"]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.roles.create', ['title' => "Role", 'btn' => "Save", 'data' => []]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                        // 'user_name' => 'required',
            ]);
            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator->errors());
            }

            if(isset($request['organization'])){
                if(($request['organization']) == "on"){
                    $organization = '1';
                }
            }else{
                $organization = '0';
            }

            if(isset($request['user_role'])){
                if(($request['user_role']) == "on"){
                    $user_role = '1';
                }
            }else{
                $user_role = '0';
            }

            if(isset($request['sales'])){
                if(($request['sales']) == "on"){
                    $sales = '1';
                }
            }else{
                $sales = '0';
            }

            if(isset($request['inventory_management'])){
                if(($request['inventory_management']) == "on"){
                    $inventory_management = '1';
                }
            }else{
                $inventory_management = '0';
            }

            if(isset($request['purchase'])){
                if(($request['purchase']) == "on"){
                    $purchase = '1';
                }
            }else{
                $purchase = '0';
            }

            if(isset($request['customer'])){
                if(($request['customer']) == "on"){
                    $customer = '1';
                }
            }else{
                $customer = '0';
            }

            if(isset($request['technical_specification'])){
                if(($request['technical_specification']) == "on"){
                    $technical_specification = '1';
                }
            }else{
                $technical_specification = '0';
            }

            if(isset($request['notification'])){
                if(($request['notification']) == "on"){
                    $notification = '1';
                }
            }else{
                $notification = '0';
            }

            if(isset($request['setting'])){
                if(($request['setting']) == "on"){
                    $setting = '1';
                }
            }else{
                $setting = '0';
            }

            if(isset($request['terms'])){
                if(($request['terms']) == "on"){
                    $terms = '1';
                }
            }else{
                $terms = '0';
            }
            $data[] = $organization;
            $data[] = $user_role;
            $data[] = $sales;
            $data[] = $inventory_management;
            $data[] = $purchase;
            $data[] = $customer;
            $data[] = $technical_specification;
            $data[] = $terms;
            $data[] = $notification;
            $data[] = $setting;
            
            $recordId = User::updateOrCreate(['id' => $request->id], [
                'name' => $request->user_name,
                'email' => $request->email_id,
                'mobile_number' => $request->phone,
                'password' => Hash::make($request->password),
                'user_type' => 'Admin',
                'permission' => json_encode($data),
            ]);
            $recordId1 = Role::updateOrCreate(['id' => $request->id1], [
                'user_id' => $recordId['id'],
                'user_name' => $request->user_name,
                'email_id' => $request->email_id,
                'phone' => $request->phone,
                'password' => $request->password,
                'confirm_password' => $request->confirm_password,
                'designation' => $request->designation,
                'organization' => $organization,
                'sales' => $sales,
                'inventory_management' => $inventory_management,
                'customer' => $customer,
                'user_role' => $user_role,
                'technical_specification' => $technical_specification,
                'terms' => $terms,
                'notification' => $notification,
                'setting' => $setting,
                'purchase' => $purchase]);
            if ($recordId) {
                session()->flash('success', 'Role created successfully');
            } else {
                session()->flash('error', "There is some thing went, Please try after some time.");
            }
            return redirect()->route('role.index');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->route('role.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return Datatables::of(Role::orderBy('id','desc')->get())->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        return view('admin.roles.edit', ['title' => "Role", 'btn' => "Update", 'data' => Role::where('id','=',$id)->first()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        
        $data = Role::find($id);
        $data1 = User::find($data->user_id);
        $data1->delete();
        $data->delete();
        $response = array('status' => 'success', 'msg' => 'Record Deleted Successfully.');
        return response()->json($response);
    }

}
