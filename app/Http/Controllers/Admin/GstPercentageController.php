<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GstPercentage;
use App\Models\Organization;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class GstPercentageController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
 $data = Organization::select('*')->get();
        return view('admin.gst.edit', ['title' => "USD", 'btn' => "Update", 'data' => GstPercentage::find('3'),'data2' => $data]);    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $data = Organization::select('*')->get();
        return view('admin.gst.create', ['title' => "Usd", 'btn' => "Save", 'data' => []]);
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
                       // 'cgst' => 'required',
            ]);
            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator->errors());
            }
            $recordId = GstPercentage::updateOrCreate(['id' => $request->id], ['organization_name' => $request->organization_name,'cgst' => $request->cgst,'sgst' => $request->sgst]);
            if ($recordId) {
                session()->flash('success', 'USD Price updated successfully');
            } else {
                session()->flash('error', "There is some thing went, Please try after some time.");
            }
            return redirect()->route('gst.index');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->route('gst.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return Datatables::of(GstPercentage::all())->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $data = Organization::select('*')->get();
        return view('admin.gst.edit', ['title' => "USD", 'btn' => "Update", 'data' => GstPercentage::find($id),'data2' => $data]);
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
        $data = GstPercentage::find($id);
        $data->delete();
        $response = array('status' => 'success', 'msg' => 'Record Deleted Successfully.');
        return response()->json($response);
    }

}
