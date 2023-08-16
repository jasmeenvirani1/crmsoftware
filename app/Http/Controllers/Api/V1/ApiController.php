<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Models\Customer;
use App\Models\MerchantCategory;
use App\Models\Quotation;
use App\Models\QuotationDetails;
use App\Models\StockManagement;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ApiController extends Controller
{
    public function GetCategory()
    {
        $group_id = Auth::user()->group_id;
        $stock = MerchantCategory::get();
        return Helper::success($stock);
    }

    public function StoreCategory(Request $request)
    {
        try {
            $group_id = Auth::user()->group_id;
            $validator = Validator::make($request->all(), [
                'name' => [
                    'required',
                    Rule::unique('merchant_categories')->where(function ($query) use ($request, $group_id) {
                        return $query->where('group_id', $group_id);
                    })->ignore($request->id, 'id')
                ],
            ]);

            if ($validator->fails()) {
                return Helper::fail([], Helper::error_parse($validator->errors()));
            }

            $data = AddDateTime($request);
            MerchantCategory::create($data);

            return Helper::success([], 'Category created Successfully');
        } catch (Exception $e) {
            return Helper::fail([], $e->getMessage());
        }
    }
    public function EditCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required'],
        ]);

        if ($validator->fails()) {
            return Helper::fail([], Helper::error_parse($validator->errors()));
        }
        try {
            $group_id = Auth::user()->group_id;
            $model = MerchantCategory::findOrFail($request->id);

            return Helper::success($model, 'Category Loaded Successfully');
        } catch (Exception $e) {
            return Helper::fail([], $e->getMessage());
        }
    }
    public function UpdateCategory(Request $request)
    {
        try {
            $group_id = Auth::user()->group_id;
            $validator = Validator::make($request->all(), [
                'name' => [
                    'required',
                    Rule::unique('merchant_categories')->where(function ($query) use ($request, $group_id) {
                        return $query->where('group_id', $group_id);
                    })->ignore($request->id, 'id')
                ],
                'id' => ['required']
            ]);

            if ($validator->fails()) {
                return Helper::fail([], Helper::error_parse($validator->errors()));
            }

            $data = AddDateTime($request);
            MerchantCategory::find($request->id)->update($data);

            return Helper::success(null, 'category updated Successfully');
        } catch (Exception $e) {
            return Helper::fail([], $e->getMessage());
        }
    }
    public function DeleteCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required'],
        ]);

        if ($validator->fails()) {
            return Helper::fail([], Helper::error_parse($validator->errors()));
        }
        try {
            MerchantCategory::findOrFail($request->id)->delete();
            return Helper::success(null, 'Category Deleted Successfully');
        } catch (Exception $e) {
            return Helper::fail([], $e->getMessage());
        }
    }
    public function GetCompany()
    {
        $customer = Customer::get();
        return Helper::success($customer, 'Company load successfully');
    }

    public function SetDefaultCompany(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required'],
        ]);

        if ($validator->fails()) {
            return Helper::fail([], Helper::error_parse($validator->errors()));
        }

        Customer::where('id', '!=', 0)->update(['default' => '0']);
        Customer::find($request->id)->update(['default' => '1']);

        return Helper::success(null, 'Company set default successfully');
    }
    public function GetCatalogue(Request $request)
    {
        $group_id = Auth::user()->group_id;


        $default_company = Customer::where('default', '1')->first();
        if (!$default_company) {
            return Helper::fail([], 'Please select default company');
        }

        $product_data['default_company'] = $default_company;

        $sql = StockManagement::with(['productImages', 'category']);

        if (isset($data['ids'])) {
            $ids = $data['ids'];
            $sql->whereIn('id', $ids);
        }
        $product_data['catalogue_data'] = $sql->get();

        return Helper::success($product_data, 'Catalogue Loaded Successfully');
    }

    public function GetVendors()
    {
        $data = Quotation::get();
        return Helper::success($data, 'Vendor store successfully');
    }

    public function EditVendor(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            return Helper::fail($validator->errors(), Helper::error_parse($validator->errors()));
        }
        $vendor = Quotation::find($request->id);
        return Helper::success($vendor, 'Vendor store successfully');
    }

    public function StoreVendor(Request $request)
    {
        $group_id = Auth::user()->group_id;
        $data = $request->json()->all();

        $validator = Validator::make($data, [
            'companyname' => [
                'required',
                Rule::unique('quotation')->where(function ($query) use ($group_id) {
                    return $query->where('group_id', $group_id);
                })
            ],
            'address' => ['required'],
            'gst' => [
                'required', 'string', 'size:15',
                Rule::unique('quotation', 'gst')->where(function ($query) use ($data, $group_id) {
                    return $query->where('gst', $data['gst'])->where('group_id', $group_id);
                })
            ],
            'notes' => ['required']
        ]);
        if ($validator->fails()) {
            return Helper::fail($validator->errors(), Helper::error_parse($validator->errors()));
        }

        $insertData = [
            'companyname' => $data['companyname'],
            'address' => $data['address'],
            'notes' => $data['notes'],
            'gst' => $data['gst'],
            'group_id' => $group_id
        ];

        $quotation_id = Quotation::insertGetId($insertData);

        foreach ($data['contact_details'] as $contact_details) {
            $contact_details['quotation_id'] = $quotation_id;
            $contact_details['created_at'] = $contact_details['updated_at'] = GetDateTime();
            QuotationDetails::insert($contact_details);
        }

        return Helper::success(null, 'Vendor store successfully');
    }

    public function UpdateVendor(Request $request)
    {
        $group_id = Auth::user()->group_id;
        $data = $request->json()->all();

        $validator = Validator::make($data, [
            'id' => ['required'],
            'companyname' => [
                'required',
                Rule::unique('quotation')->where(function ($query) use ($group_id) {
                    return $query->where('group_id', $group_id);
                })->ignore($data['id'])
            ],
            'address' => ['required'],
            'gst' => [
                'required', 'string', 'size:15',
                Rule::unique('quotation', 'gst')->where(function ($query) use ($data, $group_id) {
                    return $query->where('gst', $data['gst'])->where('group_id', $group_id);
                })->ignore($data['id'])
            ],
            'notes' => ['required']
        ]);
        if ($validator->fails()) {
            return Helper::fail($validator->errors(), Helper::error_parse($validator->errors()));
        }

        $insertData = [
            'companyname' => $data['companyname'],
            'address' => $data['address'],
            'notes' => $data['notes'],
            'gst' => $data['gst'],
        ];

        $quotation_id = Quotation::find($data['id'])->update($insertData);

        return Helper::success(null, 'Vendor updated successfully');
    }

    public function DeleteVendor(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            return Helper::fail($validator->errors(), Helper::error_parse($validator->errors()));
        }
        $quotation = Quotation::find($request->id)->delete();
        return Helper::success(null, 'Vendor delete successfully');
    }
}
