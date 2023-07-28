<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class VendorController extends Controller
{
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('admin.vendor.index', ['title' => "Vendor"]);
    }

    public function getState(Request $request)
    {
        $data['states'] = State::where("country_id",$request->country_id)->get(["name","id"]);
        return response()->json($data);
    }

    public function getCity(Request $request)
    {
        $data['cities'] = City::where("state_id",$request->state_id)
                    ->get(["name","id"]);
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $countryname = Country::get();
        return view('admin.vendor.create', ['title' => "Vendor", 'btn' => "Save", 'data' => [],'country' => $countryname]);
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
                        // 'name' => 'required',
            ]);
            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator->errors());
            }
            $recordId = Vendor::updateOrCreate(['id' => $request->id], 
                ['name' => $request->name,
                'vendor_company_name' => $request->vendor_company_name,
                'vendor_gst_no' => $request->vendor_gst_no,
                'vendor_pan_no' => $request->vendor_pan_no,
                'vendor_contact_no' => $request->vendor_contact_no,
                'email' => $request->email,
                'vendor_company_address' => $request->vendor_company_address,
                'vendor_company_city' => $request->vendor_company_city,
                'vendor_company_state' => $request->vendor_company_state,
                'vendor_company_country' => $request->vendor_company_country,
                'vendor_company_pincode' => $request->vendor_company_pincode,
                'status' => $request->status]);
            if ($recordId) {
                session()->flash('success', 'Vendor created successfully');
            } else {
                session()->flash('error', "There is some thing went, Please try after some time.");
            }
            return redirect()->route('vendor.index');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->route('vendor.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return Datatables::of(Vendor::orderBy('id','desc')->get())->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $data = Vendor::where('id','=',$id)->get();
        return view('admin.vendor.edit', ['title' => "Vendor", 'btn' => "Update", 'data' => Vendor::find($id),'country' => Country::get(),'state' => State::get(),'city' => City::get()]);
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
        $data = Vendor::find($id);
        $data->delete();
        $response = array('status' => 'success', 'msg' => 'Record Deleted Successfully.');
        return response()->json($response);
    }

}
