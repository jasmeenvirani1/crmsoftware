<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quotation;
use App\Models\StockManagement;
use App\Models\QuotationItemDetails;
use App\Models\TechnicalSpecification;
use App\Models\TechSpecification;
use App\Models\Customer;
use App\Models\Terms;
use App\Models\Term;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class EditQuotationController extends Controller
{
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('admin.quotation.index', ['title' => "Sales"]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $demo = rand(1000,9999);
        $data = "LPM" .$demo;
        $currentDateTime =  Carbon::now()->format('d-m-Y');
        return view('admin.quotation.create', ['title' => "Sales", 'btn' => "Save", 'data' => [],'customer' => Customer::get(),'terms' => Term::get(),'tech' => TechSpecification::get(),'product' => StockManagement::get(),'data1' => $data,'data2' => $currentDateTime]);
    }

    public function getTerms(Request $request) {
        $data['terms'] = Term::where("title",$request->term)->get();
        return response()->json($data);
    }

    public function getTech_specification(Request $request){
        $data['tech_specification'] = TechSpecification::where("product_name",$request->tech_specification)->get();
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
     {
        // dd($request->all());
            try {
            $validator = Validator::make($request->all(), [
                       // 'quotation_no' => 'required',
            ]);
            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator->errors());
            }
            $recordId = Quotation::updateOrCreate(['id' => $request->id], 
                ['companyname' => $request->company_name,
                'personname' => json_encode(array_filter($request->personmame)),
                'phonenumber'=>json_encode(array_filter($request->phonenumber)),
                'email' => json_encode(array_filter($request->email)),
                'address' => $request->address,
                'gst' => $request->gstin,
                'notes' => $request->notes]);
            if ($recordId) {
                session()->flash('success', 'Vendor Updated successfully');
            } else {
                session()->flash('error', "There is some thing went, Please try after some time.");
            }
            return redirect()->route('quotation.index');
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
        return Datatables::of(Quotation::all())->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $data = Quotation::find($id);
        $data1=QuotationItemDetails::with('tech_specification')->select('*')->where('quotation_id','=',$data->id)->get();
        $data2=QuotationItemDetails::with('terms')->select('*')->where('quotation_id','=',$data->id)->get();
        return view('admin.quotation.edit', ['title' => "Vendor", 'btn' => "Update", 'data' => $data,'data1' => $data1,'customer' => Customer::get(),'terms' => Term::get(),'tech' => TechSpecification::get(),'product' => StockManagement::get(),'data2' => QuotationItemDetails::with('terms')->select('*')->where('quotation_id','=',$data->id)->get()]);
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
        $data = Quotation::find($id);
        $data1=QuotationItemDetails::with('tech_specification')->select('*')->where('quotation_id','=',$data->id)->get();
        //$data = PurchaseOrder::select('*')->get();
        // $datai=Vendor::select('*')->where('vendor_name','=',$data->vendor_name)->get();
        // $data1=Organization::select('*')->where('organization_name','=',$data->organization_name)->get();
        return view('admin.quotation.invoice',['title' => "Quotation", 'btn' => "Update", 'data' => $data,'data1' =>$data1]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $data = Quotation::find($id);
        $data->delete();
        $response = array('status' => 'success', 'msg' => 'Record Deleted Successfully.');
        return response()->json($response);
    }

}
