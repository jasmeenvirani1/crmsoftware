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
use App\Models\User;
use App\Models\Organization;
use App\Models\Notification;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class QuotationController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('admin.quotation.index', ['title' => "Vendors"]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        if ((date("m")) <= 3){
            $data = (date("y") - 1);
            $data1 = date("y");
            $data2 = "$data-$data1";
        }
        else{
            $data = (date("y"));
            $data1 = (date("y") + 1);
            $data2 = "$data-$data1";
        }
        $demo = Quotation::orderBy('id','DESC')->first();
        $demo1 = isset($demo->quotation_no);
        $a = isset($demo->quotation_no) + 1;
        $demo2 = str_pad( $a, 4, "0", STR_PAD_LEFT );
        $data1 = "$demo2/$data2";
        $currentDateTime =  Carbon::now()->format('d-m-Y');
        return view('admin.quotation.create', ['title' => "Vendor", 'btn' => "Save", 'data' => [],'customer' => Customer::get(),'terms' => Term::get(),'tech' => TechSpecification::get(),'product' => StockManagement::get(),'demo1' => $demo2,'data1' => $data1,'data2' => $currentDateTime,'organization' => Organization::all(),'user' => User::all()]);
    }

    public function getTerms(Request $request) {
        $data['terms'] = Term::where("title",$request->term)->get();
        return response()->json($data);
    }

    public function getTech_specification(Request $request){
        $data = TechSpecification::where("product_name",$request->tech_specification)->first();
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
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
                session()->flash('success', 'Vendor created successfully');
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
        return Datatables::of(Quotation::orderBy('id','desc')->get())->make(true);
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
        return view('admin.quotation.edit', ['title' => "Vendor", 'btn' => "Update", 'data' => $data,'data1' => $data1,'customer' => Customer::get(),'terms' => Term::get(),'tech' => TechSpecification::get(),'product' => StockManagement::get(),'data2' => QuotationItemDetails::with('terms')->select('*')->where('quotation_id','=',$data->id)->get(),'user' => User::all(),'organization' => Organization::all()]);
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
        $data = Quotation::with('customer')->find($id);
        $data1=QuotationItemDetails::with('tech_specification')->select('*')->where('quotation_id','=',$data->id)->get();
        $data2 = User::where('id','=',$data->prepared_by)->get();
        //$data = PurchaseOrder::select('*')->get();
        // $datai=Vendor::select('*')->where('vendor_name','=',$data->vendor_name)->get();
        $organization = Organization::select('*')->where('organization_name','=',$data->organization_name)->get();
        $term = Term::get();
        return view('admin.quotation.invoice',['title' => "Quotation", 'btn' => "Update", 'data' => $data,'data1' =>$data1, 'data2' => $data2,'organization' => $organization,'term' => $term]);
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

    public function organization_name(Request $request){
        $demo = Quotation::where('organization_name','=',$request->organization_name)->orderBy('id','DESC')->first();
        if ((date("m")) <= 3){
            $data = (date("y") - 1);
            $data1 = date("y");
            $data2 = "$data-$data1";
        }
        else{
            $data = (date("y"));
            $data1 = (date("y") + 1);
            $data2 = "$data-$data1";
        }
        $a = $demo->quotation_no + 1;
        $demo2 = str_pad($a, 4, "0", STR_PAD_LEFT );
        $data1 = "$demo2/$data2";
        $response = array('demo2' => $demo2 , 'data1' => $data1);
        return response()->json($response);
    }

    public function notification() {
        $data = Quotation::with('customer')->select('*')->get();
        $date = new DateTime();
                $data1 = $date->format('Y-m-d');
        $data12 = $date->format('d/m/Y');
        foreach($data as $demo){
            $a = $demo->follow_up;
            $b = 'Today You have to Take a FollowUp of This QuotationNo. Id '.$demo->quotation_no[0];
                    if($a == $data12){
                        // echo ($demo['customer']->email);
                        $user = User::where('id','=',$demo->prepared_by)->select('*')->get();
                       $demo['customer']->notify(new \App\Notifications\quotationuser($demo,$user[0]));
                        // echo $user[0]->email;
                       $user[0]->notify(new \App\Notifications\quotationvendor($demo));
                        $recordId = Notification::updateOrCreate(
                        ['name' => 'Quotation',
                        'number' => $demo->quotation_no[0],
                        'message' => $b,
                        'date' => $data1,
                    ]);
                    }
                    else{
                        // echo "Not Match";
                    }
                    // echo "</br>";
                }
        return view('admin.quotation.index',['title'=>'Vendor']);
    }

}
