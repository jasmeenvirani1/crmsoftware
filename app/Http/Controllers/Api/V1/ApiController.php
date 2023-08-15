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
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ApiController extends Controller
{
    public $user;
    function __construct()
    {
        $this->user = Helper::GetUserData();
    }

    public function GetCategory()
    {
        $group_id = $this->user->group_id;
        $stock_management_model = new MerchantCategory($group_id);
        return Helper::success($stock_management_model->get());
    }

    public function StoreCategory(Request $request)
    {
        try {
            $group_id = $this->user->group_id;
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

            $model = new MerchantCategory($group_id);
            $model->name = $request->name;
            $model->created_at = $model->updated_at = GetDateTime();
            $recordId  = $model->save();

            return Helper::success($recordId, 'category created Successfully');
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
            $group_id = $this->user->group_id;
            $model = new MerchantCategory($group_id);
            $model = $model->findOrFail($request->id);

            return Helper::success($model, 'Category Loaded Successfully');
        } catch (Exception $e) {
            return Helper::fail([], $e->getMessage());
        }
    }
    public function UpdateCategory(Request $request)
    {
        try {
            $group_id = $this->user->group_id;
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

            $model = new MerchantCategory($group_id);

            $model = $model->findOrFail($request->id);
            $model->name = $request->name;
            $model->updated_at = GetDateTime();
            $recordId  = $model->save();

            return Helper::success($recordId, 'category updated Successfully');
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

            $group_id = $this->user->group_id;
            $model = new MerchantCategory($group_id);
            $model = $model->findOrFail($request->id);
            $model->delete();

            return Helper::success(null, 'Category Deleted Successfully');
        } catch (Exception $e) {
            return Helper::fail([], $e->getMessage());
        }
    }
    public function GetCatalogue(Request $request)
    {
        $group_id = $this->user->group_id;

        $customer_model = new Customer($group_id);
        $default_company = $customer_model->where('default', '1')->first();
        if (!$default_company) {
            return Helper::fail([], 'Please select default company');
        }
        $product_data['default_company'] = $default_company;

        $data = $request->json()->all();
        $sql = new StockManagement($group_id);
        $product = $sql->with(['category', 'productImages'])->where('group_id', $group_id);

        if (isset($data['ids'])) {
            $ids = $data['ids'];
            $product = $product->whereIn('id', $ids);
        }
        $product_data['catalogue_data'] = $product->get();


        return Helper::success($product_data, 'Catalogue Loaded Successfully');
    }
    public function GetCompany()
    {
        $group_id = $this->user->group_id;
        $customer_model = new Customer($group_id);
        return Helper::success($customer_model->get(), 'Company load successfully');
    }
    public function SetDefaultCompany(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required'],
        ]);

        if ($validator->fails()) {
            return Helper::fail([], Helper::error_parse($validator->errors()));
        }
        $group_id = $this->user->group_id;
        $set_all_default = $customer_model = new Customer($group_id);
        $set_all_default->where('id', '!=', 0)->update(['default' => '0']);

        $customer_model->find($request->id)->update(['default' => '1']);
        return Helper::success(null, 'Company set default successfully');
    }
    public function GetVendors()
    {
        $group_id = $this->user->group_id;
        $data = new Quotation($group_id);

        return Helper::success($data->get(), 'Vendor store successfully');
    }

    public function EditVendor(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            return Helper::fail($validator->errors(), Helper::error_parse($validator->errors()));
        }
        $group_id = $this->user->group_id;
        $quotation = new Quotation($group_id);
        $vendor = $quotation->find($request->id);
        return Helper::success($vendor, 'Vendor store successfully');
    }

    public function StoreVendor(Request $request)
    {
        $group_id = $this->user->group_id;
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
        $group_id = $this->user->group_id;
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
            'gst' => $data['gst'],
            'group_id' => $group_id
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
        $group_id = $this->user->group_id;
        $quotation = new Quotation($group_id);
        $vendor = $quotation->find($request->id)->delete();
        return Helper::success($vendor, 'Vendor delete successfully');
    }
}
