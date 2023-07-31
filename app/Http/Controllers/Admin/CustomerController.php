<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('admin.customer.index', ['title' => "Company"]);
    }

    public function getState(Request $request)
    {
        $data['states'] = State::where("country_id",$request->country_id)->get(["name","id"]);
        return response()->json($data);
    }

    public function getCity(Request $request)
    {
        $data['cities'] = City::where("state_id",$request->state_id)
                    ->get(["name","id"]);
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $countryname = Country::get();
        return view('admin.customer.create', ['title' => "Company", 'btn' => "Save", 'data' => [],'country' => $countryname]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        try {
            $files = [];
        if ($request->hasfile('gst')) {
            foreach ($request->file('gst') as $key => $file) {
                $name = time() . rand(1, 50) . '.' . $file->extension();
                $file->move(public_path('gst'), $name);
                $files[] = $name;
            }
        }

        $vendorimages = [];
        if ($request->hasfile('pancard')) {
            $image = $request->file('pancard');
            foreach ($request->file('pancard') as $key =>  $file1) {
                $name1 = time() . rand(1, 50) . '.' . $file1->extension();
                $file1->move(public_path('pancard'), $name1);
                $vendorimages[] = $name1;
            }
        }
        $clientimage = [];
        if ($request->hasfile('cheque')) {
            $image = $request->file('cheque');
            foreach ($request->file('cheque') as $key => $file2) {
                $name2 = time() . rand(1, 50) . '.' . $file2->extension();
                $file2->move(public_path('cheque'), $name2);
                $clientimage[] = $name2;
            }
        }
            $recordId = Customer::Create(
                ['name' => json_encode(array_filter($request->companyname)),
                // 'designation' => Crypt::encryptString($request->designation),
                // 'priority' => $request->priority,
                'email' => json_encode(array_filter($request->email)),
                'phonenumber' => json_encode(array_filter($request->phonenumber)),
                'address' => json_encode(array_filter($request->address)),
                'gst' => json_encode($files),
                'pancard' => json_encode($vendorimages),
                'cheque' => json_encode($clientimage),
                ]);
            if ($recordId) {
                session()->flash('success', 'Compnay created successfully');
            } else {
                session()->flash('error', "There is some thing went, Please try after some time.");
            }
            return redirect()->route('customer.index');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->route('customer.create');
        }
    }

    public function customereditstore(Request $request)
    {
           // try {
            $validator = Validator::make($request->all(), [
                // 'product_name' => 'required',
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
                ['name' => json_encode(array_filter($request->companyname)),
                // 'designation' => Crypt::encryptString($request->designation),
                // 'priority' => $request->priority,
                'email' => json_encode(array_filter($request->email)),
                'phonenumber' => json_encode(array_filter($request->phonenumber)),
                'address' => json_encode(array_filter($request->address)),
                'gst' => json_encode($files),
                'pancard' => json_encode($vendorimages),
                'cheque' => json_encode(($clientimage)),
                ]);

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
    public function show($id) {
        return Datatables::of(Customer::orderBy('id', 'desc')->get())->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $data = Customer::where('id','=',$id)->get();
        return view('admin.customer.edit', ['title' => "Company", 'btn' => "Update", 'data' => Customer::find($id),'country' => Country::get(),'state' => State::get(),'city' => City::get()]);
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
        $data = Customer::find($id);
        $data->delete();
        $response = array('status' => 'success', 'msg' => 'Record Deleted Successfully.');
        return response()->json($response);
    }

}
