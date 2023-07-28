<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inward;
use App\Models\Balanced;
use App\Models\OutWard;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class OutwardController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $data = Balanced::where('stock_id','=',$request->stock_id)->get();
        $data1 = ($data[0]['balanced_qty']) - ($request->outward_qty);
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
            $recordId->outward_qty = $request->outward_qty;
            $recordId->lpm_no = $request->lpm_no;
            $recordId->project_name = $request->project_name;
            $recordId->notes = $request->notes;
            $recordId->balanced_qty = $data1;
            $recordId->save();
            // $recordId = OutWard::updateOrCreate(['id' => $request->id], 
            //     ['stock_id' => $request->stock_id,
            //     'outward_qty' => $request->outward_qty,
            //     'status' => $request->status]);
            $recordId = Balanced::updateOrCreate(['id' => $data[0]['id']], 
                ['stock_id' => $data[0]['stock_id'],
                'balanced_qty' => $data1,
                'status' => $request->status]);
            if ($recordId) {
                session()->flash('success', 'Outward created successfully');
            } else {
                session()->flash('error', "There is some thing went, Please try after some time.");
            }
            return redirect()->route('stock.index');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->route('stock.outward');
        }
    }

    public function edit($id) {
        $data = OutWard::where('stock_id','=',$id)->get();
        return view('admin.stock.outward', ['title' => "Outward", 'btn' => "Save", 'data' => OutWard::where('stock_id','=',$id)->get()]);
    }

}
