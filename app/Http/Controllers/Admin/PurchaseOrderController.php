<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PurchaseOrder;
use App\Models\Vendor;
use App\Models\User;
use App\Models\Organization;
use App\Models\GstPercentage;
use App\Models\TechSpecification;
use App\Models\Notification;
use DateTime;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class PurchaseOrderController extends Controller
{
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('admin.purchase.index', ['title' => "Purchase"]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $demo = PurchaseOrder::orderBy('id','DESC')->first();
        $a = $demo->po_no_of + 1;
        $demo1 = str_pad( $a, 4, "0", STR_PAD_LEFT );
        $demo2 = "PO/".$demo1;
        return view('admin.purchase.create', ['title' => "Purchase", 'btn' => "Save", 'data' => [],'customer' => Vendor::all(),'tech' => TechSpecification::get(),'organization' => Organization::all(),'user' => User::all(),'demo1' => $demo1,'demo2' => $demo2]);
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
            $recordId = PurchaseOrder::updateOrCreate(['id' => $request->id], 
                ['organization_name' => $request->organization_name,
                'ship_to' => $request->ship_to,
                'lpm_no' => $request->lpm_no,
                'po_no' => $request->po_no,
                'po_no_of' => $request->po_no_of,
                'revision_no' => $request->revision_no,
                'project_credentials' => $request->project_credentials,
                'vendor_name' => $request->vendor_name,
                'priority' => $request->priority,
                'product_name' => json_encode($request->product_name),
                'description' => json_encode($request->description),
                'quantity' => json_encode($request->quantity),
                'unit_price' => json_encode($request->unit_price),
                'total_price' => json_encode($request->total_price),
                'comments' => $request->comments,
                'delivery_date' => $request->delivery_date,
                'payment_terms' => $request->payment_terms,
                'prepared_by' => $request->prepared_by,
                'approved_by' => $request->approved_by,
                'status' => $request->status]);
            if ($recordId) {
                session()->flash('success', 'Purchase created successfully');
            } else {
                session()->flash('error', "There is some thing went, Please try after some time.");
            }
            return redirect()->route('purchase.index');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->route('purchase.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return Datatables::of(PurchaseOrder::with('vendor')->orderBy('id','desc')->get())->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        // $data = PurchaseOrder::where('id','=',$id)->get();
        return view('admin.purchase.edit', ['title' => "Purchase", 'btn' => "Update", 'data' => PurchaseOrder::find($id),'customer' => Vendor::all(),'tech' => TechSpecification::get(),'user' => User::all(),'organization' => Organization::all()]);
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

     public function invoice($id) {
        $data = PurchaseOrder::find($id);
        //$data = PurchaseOrder::select('*')->get();
        $datai=Vendor::select('*')->where('id','=',$data->vendor_name)->get();
        $data1=Organization::select('*')->where('organization_name','=',$data->organization_name)->get();
        $data2=GstPercentage::select('*')->where('organization_name','=',$data->organization_name)->get();
        return view('admin.purchase.invoice',['title' => "Purchase", 'btn' => "Update", 'data' => $data, 'data1' => $data1,'data2'=>$datai,'data3'=>$data2]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $data = PurchaseOrder::find($id);
        $data->delete();
        $response = array('status' => 'success', 'msg' => 'Record Deleted Successfully.');
        return response()->json($response);
    }

    public function notification() {
        $data = PurchaseOrder::with('vendor')->select('*')->get();
        $date = new DateTime();
        $data12 = $date->format('Y-m-d');
        foreach($data as $demo){
            $a = $demo->delivery_date;
            $b = 'Today You have to Take a Review of This PurchseOrder Id '.$demo->po_no;
                    if($a == $data12){
                        $data1 = User::where('name','=',$demo->prepared_by)->get();
                        // echo $data1[0]->email;
                        // echo "</br>";
                        // echo $demo['vendor']->vendor_email_id;
                        $data1[0]->notify(new \App\Notifications\purchaseorderuser($demo));
                        $demo['vendor']->notify(new \App\Notifications\purchaseordervendor($demo));
                        $recordId = Notification::updateOrCreate( 
                        ['name' => 'Purchase',
                        'number' => $demo->po_no,
                        'message' => $b,
                        'date' => $data12,
                    ]);
                    }
                    else{
                        // echo "Not Match";
                    }
            // echo "</br>";
        }
        return view('admin.purchase.index', ['title' => "Purchase"]);
    }

}
