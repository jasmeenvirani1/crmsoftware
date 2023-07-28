<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class ExtraCustomerController extends Controller
{
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
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
                      //  'name' => 'required',
            ]);
            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator->errors());
            }
            $recordId = Customer::updateOrCreate(['id' => $request->id], 
                ['name' => Crypt::encryptString($request->name),
                // 'designation' => Crypt::encryptString($request->designation),
                'priority' => $request->priority,
                'gst_no' => Crypt::encryptString($request->gst_no),
                'pan_no' => Crypt::encryptString($request->pan_no),
                'phone' => Crypt::encryptString($request->phone),
                'email' => Crypt::encryptString($request->email),
                'company_name' => Crypt::encryptString($request->company_name),
                'company_address' => $request->company_address,
                'company_city' => $request->company_city,
                'company_state' => $request->company_state,
                'company_country' => $request->company_country,
                'status' => $request->status]);
            if ($recordId) {
                session()->flash('success', 'Customer created successfully');
            } else {
                session()->flash('error', "There is some thing went, Please try after some time.");
            }
            return redirect()->route('quotation.create');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->route('quotation.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
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
    }

}
