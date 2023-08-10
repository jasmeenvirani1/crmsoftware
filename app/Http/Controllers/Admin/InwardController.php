<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inward;
use App\Models\Balanced;
use App\Models\OutWard;
use App\Models\Quotation;
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
    public function store(Request $request)
    {
        $balance_id = "";
        $balance_stock_id = $request->stock_id;
        $balanced_qty = $request->inward_qty;
        try {
            $validator = Validator::make($request->all(), [
                // 'product_name' => 'required',
            ]);

            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator->errors());
            }

            $balance = Balanced::where('stock_id', '=', $request->stock_id)->first();
            if ($balance) {
                $balanced_qty = ($balance->balanced_qty) + ($request->inward_qty);
                $balance_id = $balance->id;
                $balance_stock_id = $balance->stock_id;
            }

            $recordId = new Inward;
            $recordId->stock_id = $balance_stock_id;
            $recordId->inward_qty = $balanced_qty;
            $recordId->vendor_name = $request->vendor_name;
            $recordId->product_price = $request->product_price;
            $recordId->po_no = $request->po_no;
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
                session()->flash('success', 'Inward created successfully');
            } else {
                session()->flash('error', "There is some thing went, Please try after some time.");
            }
            return redirect()->route('stock.index');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            // return redirect()->route('stock.inward');
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        // $data = Inward::where('stock_id', '=', $id)->get();
        $vendors = Quotation::all();
        return view('admin.stock.inward', ['title' => "Inward", 'btn' => "Save", 'data' => Inward::where('stock_id', '=', $id)->get(), 'vendors' => $vendors, 'id' => $id]);
    }
}
