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
