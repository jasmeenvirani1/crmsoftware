<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Models\Balanced;
use App\Models\ClientAndSalesImage;
use App\Models\Inward;
use App\Models\MerchantCategory;
use App\Models\OutWard;
use App\Models\ProductDimension;
use App\Models\ProductImage;
use App\Models\StockManagement;
use App\Models\State;
use Illuminate\Support\Facades\Validator;
use App\Models\Quotation;
use App\Models\StockVendor;
use App\Models\VendorImage;
use Illuminate\Support\Facades\Auth;
use Svg\Tag\Rect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class CommanList extends Controller
{
    public $user;
    function __construct()
    {
        $this->user = Helper::GetUserData();
    }

    public function getCategory(Request $request)
    {
        try {
            return Helper::success(MerchantCategory::all());
        } catch (\Exception $e) {

            return Helper::fail([], $e->getMessage());
        }
    }

    public function createCategory(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
            ]);
            if ($validator->fails()) {
                return Helper::fail([], Helper::error_parse($validator->errors()));
            }
            $recordId = MerchantCategory::Create(['name' => $request->name]);
            return Helper::success($recordId, 'category created Successfully');
        } catch (\Exception $e) {
            return Helper::fail([], $e->getMessage());
        }
    }
    public function editCategory(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
            ]);
            if ($validator->fails()) {
                return Helper::fail([], Helper::error_parse($validator->errors()));
            }
            $recordId = MerchantCategory::updateOrCreate(['id' => $request->id], ['name' => $request->name]);
            return Helper::success($recordId, 'category updated Successfully');
        } catch (\Exception $e) {
            return Helper::fail([], $e->getMessage());
        }
    }
    public function deleteCategory(Request $request)
    {
        try {
            MerchantCategory::where(['id' => $request->id])->delete();
            return Helper::success([], 'category deleted successfully');
        } catch (\Exception $e) {
            return Helper::fail([], $e->getMessage());
        }
    }

    public function createproduct(Request $request)
    {
        $group_id = $this->user->group_id;

        $stock_management_model = new StockManagement($this->user->group_id);
        $data = $request->json()->all();

        // $validator = Validator::make($data, [
        //     'product_name' =>  [
        //         'required',
        //         Rule::unique('stock_management', 'product_name')->where(function ($query) use ($group_id) {
        //             return $query->where('group_id', $group_id);
        //         })->ignore($request->input('id'))
        //     ],
        //     'partno' => 'required',
        //     'category' => 'required',
        //     'product_company' => 'required',
        //     'product_size' => 'required|integer',
        //     'product_price' => 'required|integer',
        //     'specification' => 'required',
        //     'notes' => 'required',
        // ]);

        // if ($validator->fails()) {
        //     return Helper::fail($validator->errors(), "Enter all require param.");
        // }

        $stock_data = (object) $data;

        $product_id = $stock_management_model->insertGetId(
            [
                'product_name' => $stock_data->product_name,
                'partno' => $stock_data->partno,
                'product_company' => $stock_data->product_company,
                'product_size' => $stock_data->product_size,
                'product_price' => $stock_data->product_price,
                'category' => $stock_data->category,
                'notes' => $stock_data->notes,
                'specification' => $stock_data->specification,
                'group_id' => $group_id,
            ]
        );


        // $jsonData = json_decode($request->getContent());

        // if (isset($jsonData->product_images)) {
        //     $decodedImageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $jsonData->product_images));
        //     prx($decodedImageData);
        //     $files = $this->addImages('product_images', $product_id, $request->file('product_images'));
        //     ProductImage::insert($files);
        // }

        // // if ($request->hasfile('product_images')) {
        // //     $files = $this->addImages('product_images', $product_id, $request->file('product_images'));
        // //     ProductImage::insert($files);
        // // }
        // if ($request->hasfile('vendor_images')) {
        //     $files = $this->addImages('vendor_images', $product_id, $request->file('vendor_images'));
        //     VendorImage::insert($files);
        // }
        // if ($request->hasfile('client_images')) {
        //     $files = $this->addImages('client_images', $product_id, $request->file('client_images'));
        //     ClientAndSalesImage::insert($files);
        // }
        $dimensionDetailsArr = [];
        if (isset($stock_data->dimensions)) {

            foreach ($stock_data->dimensions as $dimensions) {
                $date_time = GetDateTime();

                $arr = [
                    'product_id' => $product_id,
                    'dimension_name' => $dimensions['dimension_name'],
                    'dimension_value' => $dimensions['dimension_value'],
                    'quantities_value' => $dimensions['quantities_value'],
                    'created_at' => $date_time,
                    'updated_at' => $date_time
                ];
                ProductDimension::create($arr);
            }
        }

        $vendor_data = [];
        foreach ($stock_data->vendors as $vendor) {
            $vendor_data = ['product_id' => $product_id, 'quotation_id' => $vendor['id']];
            StockVendor::insert($vendor_data);
        }

        return Helper::success([],'Product store successfully');
    }

    public function editproduct(Request $request)
    {
        $recordId = StockManagement::where('id', '=', $request->id)->update(
            [
                'product_name' => $request->name,
                'partno' => $request->partno,
                'product_company' => $request->company,
                'product_size' => $request->size,
                'product_price' => $request->price,
                'usd_price' => $request->usd_price,
                'category' => $request->category,
                // 'product_dimension' => json_encode($request->product_dimension),
                // 'images' => json_encode($files),
                // 'vendorimage' => json_encode($vendorimages),
                // 'clientimage' => json_encode($clientimage),
                'notes' => $request->notes,
                'specification' => $request->specification,
                'status' => $request->status,
            ]
        );
        $success = StockManagement::where('id', '=', $request->id)->first();
        return Helper::success($success, 'product  updated Successfully');
    }

    public function deleteproduct(Request $request)
    {
        try {
            StockManagement::where(['id' => $request->id])->delete();
            return Helper::success([], 'product deleted successfully');
        } catch (\Exception $e) {
            return Helper::fail([], $e->getMessage());
        }
    }

    public function getproduct(Request $request)
    {
        try {
            $success = StockManagement::all();
            foreach ($success as $key => $image) {
                $success['productimage']  = url('product_image/' . $image->images[$key]);
                $success['vendorimage'] = url('vendor_image/' . $image->vendorimage[$key]);
                $success['clientimage']  = url('client_image/' . $image->clientimage[$key]);
            }
            return Helper::success($success, 'product fetch successfully');
        } catch (\Exception $e) {
            return Helper::fail([], $e->getMessage());
        }
    }

    public function createvendor(Request $request)
    {
        try {
            $recordId = Quotation::Create(
                [
                    'companyname' => $request->company_name,
                    'personname' => json_encode($request->personname),
                    'phonenumber' => json_encode($request->phonenumber),
                    'email' => json_encode($request->email),
                    'address' => $request->address,
                    'gst' => $request->gstin,
                    'notes' => $request->notes
                ]
            );

            return Helper::success($recordId, 'vendor add successfully');
        } catch (\Exception $e) {
            return Helper::fail([], $e->getMessage());
        }
    }

    public function editvendor(Request $request)
    {
        try {
            $recordId = Quotation::where('id', '=', $request->id)->update(
                [
                    'companyname' => $request->company_name,
                    'personname' => json_encode($request->personname),
                    'phonenumber' => json_encode($request->phonenumber),
                    'email' => json_encode($request->email),
                    'address' => $request->address,
                    'gst' => $request->gstin,
                    'notes' => $request->notes
                ]
            );

            return Helper::success($recordId, 'vendor edit successfully');
        } catch (\Exception $e) {
            return Helper::fail([], $e->getMessage());
        }
    }

    public function deletevendor(Request $request)
    {
        try {
            if (Quotation::where(['id' => $request->id])->exists()) {
                $data = Quotation::where(['id' => $request->id])->delete();
                $data = 'record delted successfully';
            } else {
                $data = 'no record found';
            }
            return Helper::success($data, 'vendor deleted successfully');
        } catch (\Exception $e) {
            return Helper::fail([], $e->getMessage());
        }
    }


    public function getState(Request $request)
    {
        try {
            return Helper::success(State::all());
        } catch (\Exception $e) {
            return Helper::fail([], $e->getMessage());
        }
    }
}
