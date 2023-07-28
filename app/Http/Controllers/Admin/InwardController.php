<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inward;
use App\Models\Balanced;
use App\Models\OutWard;
use App\Models\Vendor;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class InwardController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $data = Balanced::where('stock_id','=',$request->stock_id)->get();
        $data1 = ($data[0]['balanced_qty']) + ($request->inward_qty);
        try {
            $validator = Validator::make($request->all(), [
                        // 'product_name' => 'required',
            ]);
            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator->errors());
            }
            $recordId = new Inward;
            $recordId->stock_id = $request->stock_id;
            $recordId->inward_qty = $request->inward_qty;
            $recordId->vendor_name = $request->vendor_name;
            $recordId->product_price = $request->product_price;
            $recordId->po_no = $request->po_no;
            $recordId->outward_qty = $request->outward_qty;
            $recordId->lpm_no = $request->lpm_no;
            $recordId->project_name = $request->project_name;
            $recordId->notes = $request->notes;
            $recordId->balanced_qty = $data1;
            $recordId->save();
            // $recordId = Inward::updateOrCreate(['id' => $request->id], 
            //     ['stock_id' => $request->stock_id,
            //     'inward_qty' => $request->inward_qty,
            //     'status' => $request->status]);
            $recordId = Balanced::updateOrCreate(['id' => $data[0]['id']], 
                ['stock_id' => $data[0]['stock_id'],
                'balanced_qty' => $data1,
                'status' => $request->status]);
            if ($recordId) {
                session()->flash('success', 'Inward created successfully');
            } else {
                session()->flash('error', "There is some thing went, Please try after some time.");
            }
            return redirect()->route('stock.index');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->route('stock.inward');
        }
    }

    public function edit($id) {
        $data = Inward::where('stock_id','=',$id)->get();
        return view('admin.stock.inward', ['title' => "Inward", 'btn' => "Save", 'data' => Inward::where('stock_id','=',$id)->get(),'data1' => Vendor::get()]);
    }

}
