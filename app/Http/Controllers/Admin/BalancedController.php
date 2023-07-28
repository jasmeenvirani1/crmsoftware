<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inward;
use App\Models\Balanced;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class BalancedController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                        // 'product_name' => 'required',
            ]);
            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator->errors());
            }
            $recordId = Balanced::updateOrCreate(['id' => $request->id], 
                ['stock_id' => $request->stock_id,
                'balanced_qty' => $request->balanced_qty,
                'status' => $request->status]);
            if ($recordId) {
                session()->flash('success', 'Balanced created successfully');
            } else {
                session()->flash('error', "There is some thing went, Please try after some time.");
            }
            return redirect()->route('stock.index');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->route('stock.balanced');
        }
    }

    public function edit($id) {
        $data = Balanced::where('stock_id','=',$id)->get();
        return view('admin.stock.balanced', ['title' => "Balanced Module", 'btn' => "Save", 'data' => Balanced::where('stock_id','=',$id)->get()]);
    }

}
