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
    public function store(Request $request)
    {

        $balance_id = "";
        $balance_stock_id = "";
        $balanced_qty = '0';
        try {
            $validator = Validator::make($request->all(), [
                // 'product_name' => 'required',
            ]);
            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator->errors());
            }
            $balance = Balanced::where('stock_id', '=', $request->stock_id)->first();
            if ($balance) {
                $balanced_qty = ($balance->balanced_qty) - ($request->outward_qty);
                $balance_id = $balance->id;
                $balance_stock_id = $balance->stock_id;
            }

            $recordId = new Inward;
            $recordId->stock_id = $request->stock_id;
            $recordId->outward_qty = $request->outward_qty;
            $recordId->balanced_qty = $balanced_qty;
            $recordId->save();

            $recordId = Balanced::updateOrCreate(
                ['id' => $balance_id],
                [
                    'stock_id' => $balance_stock_id,
                    'balanced_qty' => $balanced_qty,
                    'status' => $request->status
                ]
            );
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

    public function edit($id)
    {
        $data = OutWard::where('stock_id', '=', $id)->get();
        return view('admin.stock.outward', ['title' => "Outward", 'btn' => "Save", 'data' => OutWard::where('stock_id', '=', $id)->get()]);
    }
}
