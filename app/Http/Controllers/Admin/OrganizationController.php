<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Organization;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class OrganizationController extends Controller
{
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('admin.organization.index', ['title' => "Organization"]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.organization.create', ['title' => "Organization", 'btn' => "Save", 'data' => []]);
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
                       // 'organization_name' => 'required',
            ]);
            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator->errors());
            }
            $image = $request->file('logo');
            $image1 = rand() . '.' . $request->logo->getClientOriginalExtension();
            $destinationPath = public_path('images');
            $image->move($destinationPath, $image1);   
            $recordId = Organization::updateOrCreate(['id' => $request->id], 
                ['organization_name' => $request->organization_name,
                'email' => json_encode($request->email),
                'website' => $request->website,
                'gst_no' => $request->gst_no,
                'pancad_no' => $request->pancad_no,
                'bank_name' => $request->bank_name,
                'account_no' => $request->account_no,
                'ifsc_code' => $request->ifsc_code,
                'branch_name' => $request->branch_name,
                'contact_no' => json_encode($request->contact_no),
                'full_address' => $request->full_address,
                'pincode' => $request->pincode,
                'logo' => $image1]);
            if ($recordId) {
                session()->flash('success', 'Organization created successfully');
            } else {
                session()->flash('error', "There is some thing went, Please try after some time.");
            }
            return redirect()->route('organization.index');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->route('organization.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return Datatables::of(Organization::orderBy('id','desc')->get())->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        // $data = Customer::where('id','=',$id)->get();
        return view('admin.organization.edit', ['title' => "Organization", 'btn' => "Update", 'data' => Organization::find($id)]);
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
        $data = Organization::find($id);
        $data->delete();
        $response = array('status' => 'success', 'msg' => 'Record Deleted Successfully.');
        return response()->json($response);
    }

}
