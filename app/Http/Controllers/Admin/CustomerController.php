<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Barryvdh\DomPDF\Facade\Pdf;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rule;
use Dompdf\Dompdf;
use Dompdf\Options;


class CustomerController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.customer.index', ['title' => "Company"]);
    }

    public function getState(Request $request)
    {
        $data['states'] = State::where("country_id", $request->country_id)->get(["name", "id"]);
        return response()->json($data);
    }

    public function getCity(Request $request)
    {
        $data['cities'] = City::where("state_id", $request->state_id)
            ->get(["name", "id"]);
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countryname = Country::get();
        return view('admin.customer.create', ['title' => "Company", 'btn' => "Save", 'data' => [], 'country' => $countryname]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $group_id = Auth::user()->group_id;
            $validator = Validator::make($request->all(), [
                'vendor_company_name' =>  [
                    'required',
                    Rule::unique('customer', 'name')->where(function ($query) use ($group_id) {
                        return $query->where('group_id', $group_id);
                    })->ignore($request->input('id'))
                ],

                'email' => 'required',
                'phonenumber' => 'required|numeric|digits:10',
                'address' => 'required',
                'gst' => [
                    'required', 'string', 'size:15',
                    Rule::unique('customer', 'gst')->where(function ($query) use ($request, $group_id) {
                        return $query->where('gst', $request->gst)->where('group_id', $group_id);
                    })
                ]
            ]);
            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator->errors());
            }

            $logo_path = "";
            if ($request->hasfile('logo')) {
                $logo_path =  uploadImage($request->file('logo'), 'company/logo');
                $logo_path = 'company/logo/' . $logo_path;
            }

            $pancard_path = "";
            if ($request->hasfile('pancard')) {
                $pancard_path =  uploadImage($request->file('logo'), 'company/pancard');
                $pancard_path = 'company/pancard/' . $pancard_path;
            }

            $cheque_path = "";
            if ($request->hasfile('cheque')) {
                $cheque_path =  uploadImage($request->file('cheque'), 'company/cheque');
                $cheque_path = 'company/cheque/' . $cheque_path;
            }
            $msme_path = "";
            if ($request->hasfile('certificate')) {
                $msme_path =  uploadImage($request->file('cheque'), 'company/msme');
                $msme_path = 'company/msme/' . $msme_path;
            }


            $recordId = Customer::Create(
                [
                    'name' => $request->vendor_company_name,
                    'email' => $request->email,
                    'phonenumber' => $request->phonenumber,
                    'address' => $request->address,
                    'gst' => $request->gst,
                    'logo' => $logo_path,
                    'pancard' => $pancard_path,
                    'cheque' => $cheque_path,
                    'msme_certificate' => $msme_path,
                ]
            );
            if ($recordId) {
                session()->flash('success', 'Company created successfully');
            } else {
                session()->flash('error', "There is some thing went, Please try after some time.");
            }
            return redirect()->route('company.index');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->route('company.create');
        }
    }

    public function customereditstore(Request $request)
    {
        //   try {
        $validator = Validator::make($request->all(), [
            'vendor_company_name' => 'required',
            'email' => 'required',
            'phonenumber' => 'required|numeric|digits:10',
            'address' => 'required',
            'gst' =>  [
                'required',
                'string',
                'size:15',
                Rule::unique('customer', 'gst')->where(function ($query) use ($request) {
                    return $query->where('gst', $request->gst);
                })->ignore($request->input('id')),
            ],
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator->errors());
        }
        $files1 = [];
        if ($request->hasfile('filenames')) {
            $image = $request->file('filenames');
            $data1 = Customer::where('id', '=', $request->id)->first();
            foreach ($request->file('filenames') as  $file) {
                $name = time() . rand(1, 50) . '.' . $file->extension();
                $file->move(public_path('product_image'), $name);
                $files1[] = $name;
            }
            $files = array_merge($files1, (isset($data1->images) && is_array($data1->images) ? $data1->images : []));
        } else {
            $path = Customer::where('id', '=', $request->id)->first();
            $files = $path->images;
        }

        $vendorimages1 = [];
        if ($request->hasfile('filenamesvendor')) {
            $image = $request->file('filenamesvendor');
            $data1 = Customer::where('id', '=', $request->id)->first();
            $oldImage = isset($data1->images);
            foreach ($request->file('filenamesvendor') as $key =>  $file1) {
                $name1 = time() . rand(1, 50) . '.' . $file1->extension();
                $file1->move(public_path('vendor_image'), $name1);
                $vendorimages1[] = $name1;
            }
            $vendorimages = array_merge($vendorimages1, (isset($data1->vendorimage) && is_array($data1->vendorimage) ? $data1->vendorimage : []));
        } else {
            $path = Customer::where('id', '=', $request->id)->first();
            $vendorimages = $path->vendorimage;
        }
        $clientimage1 = [];
        if ($request->hasfile('filenamesclient')) {
            $image = $request->file('filenamesclient');
            $data1 = Customer::where('id', '=', $request->id)->first();
            $oldImage = isset($data1->images);
            foreach ($request->file('filenamesclient') as $key => $file2) {
                $name2 = time() . rand(1, 50) . '.' . $file2->extension();
                $file2->move(public_path('client_image'), $name2);
                $clientimage1[] = $name2;
            }
            $clientimage = array_merge($clientimage1, (isset($data1->clientimage) && is_array($data1->clientimage) ? $data1->clientimage : []));
        } else {
            $path = Customer::where('id', '=', $request->id)->first();
            $clientimages = $path->clientimage;
        }
        $recordId = Customer::where('id', '=', $request->id)->update(
            [
                'name' => json_encode(array_filter($request->companyname)),
                // 'designation' => Crypt::encryptString($request->designation),
                // 'priority' => $request->priority,
                'email' => json_encode(array_filter($request->email)),
                'phonenumber' => json_encode(array_filter($request->phonenumber)),
                'address' => json_encode(array_filter($request->address)),
                'gst' => json_encode($files),
                'pancard' => json_encode($vendorimages),
                'cheque' => json_encode(($clientimage)),
            ]
        );

        if ($recordId) {
            session()->flash('success', 'compnay updated successfully');
        } else {
            session()->flash('error', "There is some thing went, Please try after some time.");
        }
        return redirect()->route('stock.index');
        // } catch (\Exception $e) {
        //     session()->flash('error', $e->getMessage());
        //     return redirect()->route('stock.create');
        // }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $data = Customer::orderBy('default', 'desc')->get();
        // return Datatables::of($data)->make(true);
        $data = Customer::orderBy('updated_at', 'desc')->get();
        return Datatables::of($data)->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.customer.edit', ['title' => "Company", 'btn' => "Update", 'data' => Customer::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $group_id = Auth::user()->group_id;
        $input = [
            'name' => $request->vendor_company_name,
            'email' => $request->email,
            'phonenumber' => $request->phonenumber,
            'address' => $request->address,
            'gst' => $request->gst,
        ];
        try {

            $validator = Validator::make($request->all(), [
                'vendor_company_name' => 'required',
                'email' => 'required',
                'phonenumber' => 'required|numeric|digits:10',
                'address' => 'required',
                'gst' =>  [
                    'required',
                    'string',
                    'size:15',
                    Rule::unique('customer', 'gst')->where(function ($query) use ($request, $group_id) {
                        return $query->where('gst', $request->gst)->where('group_id', $group_id);
                    })->ignore($id),
                ],
            ]);
            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator->errors());
            }

            $logo_path = "";
            if ($request->hasfile('logo')) {
                $logo_path =  uploadImage($request->file('logo'), 'company/logo');
                $input['logo'] = 'company/logo/' . $logo_path;
            }

            $pancard_path = "";
            if ($request->hasfile('pancard')) {
                $pancard_path =  uploadImage($request->file('pancard'), 'company/pancard');
                $input['pancard'] = 'company/pancard/' . $pancard_path;
            }

            $cheque_path = "";
            if ($request->hasfile('cheque')) {
                $cheque_path =  uploadImage($request->file('cheque'), 'company/cheque');
                $input['cheque'] = 'company/cheque/' . $cheque_path;
            }
            $msme_path = "";
            if ($request->hasfile('msme')) {
                $msme_path =  uploadImage($request->file('msme'), 'company/msme');
                $input['msme_certificate'] = 'company/msme/' . $msme_path;
            }

            $recordId = Customer::find($id)->update($input);
            if ($recordId) {
                session()->flash('success', 'Company created successfully');
            } else {
                session()->flash('error', "There is some thing went, Please try after some time.");
            }
            return redirect()->route('company.index');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->route('company.create');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Customer::find($id);
        $data->delete();
        $response = array('status' => 'success', 'msg' => 'Record Deleted Successfully.');
        return response()->json($response);
    }
    public function defaultCustomer(Request $request)
    {
        // Update 'default' field to '0' for all records with 'id' not equal to 0
        Customer::where('id', '!=', '0')->update(['default' => '0']);

        // Find the record with the requested 'id' and update its 'default' field to '1'
        $customer = Customer::find($request->id);
        if ($customer) {
            $customer->default = '1';
            $customer->save();
        }

        $response = ['status' => 'success', 'msg' => 'Record Updated Successfully.'];
        return response()->json($response);
    }
    public function Detail($id)
    {
        $company = Customer::find($id); // Assuming you have a "Company" model
        return view('admin.customer.detail', ['title' => "Company"], compact('company'));
    }
    public function generatePdf(Request $request, $id)
    {

        $company = Customer::find($id);

         //prx($company->name);
        // Use output buffering to capture PDF content
       

        //  return view('admin.customer.detail', ['company' => $company]);
        // $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('admin.customer.detail', ['company' => $company])->setOptions(['defaultFont' => 'Poppins, Helvetica, sans-serif']);
        // $download = $pdf->download('pdf_file.pdf');
        // return $download;

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('admin.customer.detail', ['company' => $company]);
        $download = $pdf->download($company->name.'.pdf');
        return $download;


        return response()->json(['message' => 'PDF generated and saved successfully']);
    }
}
