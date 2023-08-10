<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StockManagement;
use App\Models\Inward;
use App\Models\MerchantCategory;
use App\Models\OutWard;
use App\Models\Balanced;
use App\Models\ClientAndSalesImage;
use App\Models\product_images;
use App\Models\ProductDimension;
use App\Models\ProductImage;
use App\Models\Quotation;
use App\Models\StockVendor;
use App\Models\Vendor;
use App\Models\VendorImage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class StockManagementController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.stock.index', ['title' => "Product"]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = MerchantCategory::get();
        $vendors = Quotation::all();

        return view('admin.stock.create', ['title' => "Product", 'btn' => "Save", 'data' => [], 'category' => $category, 'vendors' => $vendors]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_name' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator->errors());
        }

        $recordId = StockManagement::updateOrCreate(
            ['id' => $request->id],
            [
                'product_name' => $request->product_name,
                'partno' => $request->partno,
                'product_company' => $request->product_company,
                'product_size' => $request->product_size,
                'product_price' => $request->product_price,
                'usd_price' => $request->total_amount,
                'category' => $request->company_country,
                'product_dimension' => json_encode($request->product_dimension),
                'notes' => $request->notes,
                'specification' => $request->specification,
                'status' => $request->status
            ]
        );
        $product_id = $recordId->id;
        if ($request->hasfile('product_images')) {
            $files = $this->addImages('product_images', $product_id, $request->file('product_images'));
            ProductImage::insert($files);
        }
        if ($request->hasfile('vendor_images')) {
            $files = $this->addImages('vendor_images', $product_id, $request->file('vendor_images'));
            VendorImage::insert($files);
        }
        if ($request->hasfile('client_images')) {
            $files = $this->addImages('client_images', $product_id, $request->file('client_images'));
            ClientAndSalesImage::insert($files);
        }
        $dimensionDetailsArr = [];
        if (request()->has('dimension_name')) {

            for ($i = 0; $i < count($request->dimension_name); $i++) {
                $date_time = GetDateTime();
                if ($request->dimension_name[$i] != null && $request->dimension_value[$i] != null && $request->quantities_value[$i] != null) {
                    $arr = [
                        'product_id' => $product_id,
                        'dimension_name' => $request->dimension_name[$i],
                        'dimension_value' => $request->dimension_value[$i],
                        'quantities_value' => $request->quantities_value[$i],
                        'created_at' => $date_time,
                        'updated_at' => $date_time
                    ];
                    ProductDimension::create($arr);
                    $dimensionDetailsArr[] = $arr;
                }
            }
        }

        $recordId1 = Inward::updateOrCreate(
            ['id' => $request->id],
            [
                'stock_id' => $product_id,
                'inward_qty' => $request->inward_qty,
                'outward_qty' => $request->outward_qty,
                'balanced_qty' => $request->inward_qty,
                'status' => $request->status
            ]
        );
        $recordId2 = OutWard::updateOrCreate(
            ['id' => $request->id],
            [
                'stock_id' => $product_id,
                'outward_qty' => $request->outward_qty,
                'status' => $request->status
            ]
        );
        $recordId3 = Balanced::updateOrCreate(
            ['id' => $request->id],
            [
                'stock_id' => $product_id,
                'balanced_qty' => $request->inward_qty,
                'status' => $request->status
            ]
        );
        $vendor_data = [];
        foreach ($request->vendors as $vendor) {
            $vendor_data[] = ['product_id' => $product_id, 'quotation_id' => $vendor];
        }
        StockVendor::insert($vendor_data);

        if ($product_id) {
            session()->flash('success', 'Product created successfully');
        } else {
            session()->flash('error', "There is some thing went, Please try after some time.");
        }
        return redirect()->route('stock.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = StockManagement::with('balanced')->select('*')->orderBy('id', 'desc')->get();
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
        $data = StockManagement::with(['productImages', 'vendorImages', 'clientImages', 'productDimensionData'])->find($id);
        $data1 = Inward::where('stock_id', '=', $id)->get();
        $category = MerchantCategory::get();
        $vendors = Quotation::all();
        $selected_vendors = StockVendor::where('product_id', $id)->pluck('quotation_id')->toArray();
        return view('admin.stock.edit', ['title' => "Product", 'btn' => "Update", 'data' => $data, 'data1' => $data1, 'category' => $category, 'vendors' => $vendors, 'selected_vendors' => $selected_vendors]);
    }
    // public function inward($id) {
    //     return view('admin.stock.inward', ['title' => "Inward", 'btn' => "Save", 'data' => []]);
    // }
    // public function balanced($id) {
    //     return view('admin.stock.balanced', ['title' => "Balanced", 'btn' => "Save", 'data' => []]);
    // }
    // public function outward($id) {
    //     return view('admin.stock.outward', ['title' => "Outward", 'btn' => "Save", 'data' => []]);
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {

        StockManagement::updateOrCreate(
            ['id' => $request->id],
            [
                'product_name' => $request->product_name,
                'partno' => $request->partno,
                'product_company' => $request->product_company,
                'product_size' => $request->product_size,
                'product_price' => $request->product_price,
                'usd_price' => $request->total_amount,
                'category' => $request->company_country,
                'product_dimension' => json_encode($request->product_dimension),
                'notes' => $request->notes,
                'specification' => $request->specification,
                'status' => $request->status
            ]
        );

        $product_id = $id;
        if ($request->hasfile('product_images')) {
            $files = $this->addImages('product_images', $product_id, $request->file('product_images'));
            ProductImage::insert($files);
        }
        if ($request->hasfile('vendor_images')) {
            $files = $this->addImages('vendor_images', $product_id, $request->file('vendor_images'));
            VendorImage::insert($files);
        }
        if ($request->hasfile('client_images')) {
            $files = $this->addImages('client_images', $product_id, $request->file('client_images'));
            ClientAndSalesImage::insert($files);
        }
        ProductDimension::where('product_id', $product_id)->delete();
        $dimensionDetailsArr = [];
        if (request()->has('dimension_name')) {

            for ($i = 0; $i < count($request->dimension_name); $i++) {
                $date_time = GetDateTime();
                if ($request->dimension_name[$i] != null && $request->dimension_value[$i] != null && $request->quantities_value[$i] != null) {
                    $arr = [
                        'product_id' => $product_id,
                        'dimension_name' => $request->dimension_name[$i],
                        'dimension_value' => $request->dimension_value[$i],
                        'quantities_value' => $request->quantities_value[$i],
                        'created_at' => $date_time,
                        'updated_at' => $date_time
                    ];
                    $dimensionDetailsArr[] = $arr;
                }
            }
            ProductDimension::insert($dimensionDetailsArr);
        }
        StockVendor::where('product_id', $product_id)->delete();
        $vendor_data = [];
        foreach ($request->vendors as $vendor) {
            $vendor_data[] = ['product_id' => $product_id, 'quotation_id' => $vendor];
        }
        StockVendor::insert($vendor_data);
        if ($product_id) {
            session()->flash('success', 'Product updated successfully');
        } else {
            session()->flash('error', "There is some thing went, Please try after some time.");
        }
        return redirect()->route('stock.index');
    }
    public function editstore(Request $request)
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
            $data1 = StockManagement::where('id', '=', $request->id)->first();
            foreach ($request->file('filenames') as  $file) {
                $name = time() . rand(1, 50) . '.' . $file->extension();
                $file->move(public_path('product_image'), $name);
                $files1[] = $name;
            }
            $files = array_merge($files1, (isset($data1->images) && is_array($data1->images) ? $data1->images : []));
        } else {
            $path = StockManagement::where('id', '=', $request->id)->first();
            $files = $path->images;
        }

        $vendorimages1 = [];
        if ($request->hasfile('filenamesvendor')) {
            $image = $request->file('filenamesvendor');
            $data1 = StockManagement::where('id', '=', $request->id)->first();
            $oldImage = isset($data1->images);
            foreach ($request->file('filenamesvendor') as $key =>  $file1) {
                $name1 = time() . rand(1, 50) . '.' . $file1->extension();
                $file1->move(public_path('vendor_image'), $name1);
                $vendorimages1[] = $name1;
            }
            $vendorimages = array_merge($vendorimages1, (isset($data1->vendorimage) && is_array($data1->vendorimage) ? $data1->vendorimage : []));
        } else {
            $path = StockManagement::where('id', '=', $request->id)->first();
            $vendorimages = $path->vendorimage;
        }
        $clientimage1 = [];
        if ($request->hasfile('filenamesclient')) {
            $image = $request->file('filenamesclient');
            $data1 = StockManagement::where('id', '=', $request->id)->first();
            $oldImage = isset($data1->images);
            foreach ($request->file('filenamesclient') as $key => $file2) {
                $name2 = time() . rand(1, 50) . '.' . $file2->extension();
                $file2->move(public_path('client_image'), $name2);
                $clientimage1[] = $name2;
            }
            $clientimage = array_merge($clientimage1, (isset($data1->clientimage) && is_array($data1->clientimage) ? $data1->clientimage : []));
        } else {
            $path = StockManagement::where('id', '=', $request->id)->first();
            $clientimage = $path->clientimage;
        }
        $recordId = StockManagement::where('id', '=', $request->id)->update(
            [
                'product_name' => $request->product_name,
                'product_size' => $request->product_size,
                'product_price' => $request->product_price,
                'usd_price' => $request->total_amount,
                'category' => $request->company_country,
                'product_dimension' => json_encode($request->product_dimension),
                'images' => json_encode($files),
                'vendorimage' => json_encode($vendorimages),
                'clientimage' => json_encode($clientimage),
                'notes' => $request->notes,
                'specification' => $request->specification,
                'status' => $request->status
            ]
        );

        if ($recordId) {
            session()->flash('success', 'Product updated successfully');
        } else {
            session()->flash('error', "There is some thing went, Please try after some time.");
        }
        return redirect()->route('stock.index');
    }
    public function view($id)
    {
        $data2 = StockManagement::findOrFail($id);
        $data = Inward::with('vendors')->where('stock_id', $id)->get();
        $data1 = Balanced::where('stock_id', $id)->get();
        return view('admin.stock.view', ['title' => "Transaction", 'btn' => "Save", 'data' => $data, 'data1' => $data1, 'data2' => $data2]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = StockManagement::find($id);
        $data->delete();
        $response = array('status' => 'success', 'msg' => 'Record Deleted Successfully.');
        return response()->json($response);
    }
    public function addImages($path, $product_id, $data)
    {
        $files = [];
        foreach ($data as $key => $file) {
            $arr = [
                'name' => $path . '/' . uploadImage($file, $path),
                'product_id' => $product_id,
            ];
            $files[] = $arr;
        }
        return $files;
    }
    public  function productImageDelete(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'type' => 'required|in:product_images,vendor_images,client_and_sales_images',
        ]);
        DB::table($request->type)->where('id', $request->id)->update(['deleted_at' => now()]);
        $response = array('status' => '200', 'message' => 'Record Deleted Successfully.');
        return response()->json($response);
    }
}
