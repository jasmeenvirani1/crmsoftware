<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Models\Customer;
use App\Models\Group;
use App\Models\MerchantCategory;
use App\Models\ProductDimension;
use App\Models\Quotation;
use App\Models\QuotationDetails;
use App\Models\StockManagement;
use App\Models\StockVendor;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ApiController extends Controller
{
    public function GetGroup()
    {
        $group = Group::get();
        return Helper::success($group);
    }

    public function ChangeGroup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'group_id' => ['required']
        ]);

        if ($validator->fails()) {
            return Helper::fail([], Helper::error_parse($validator->errors()));
        }

        try {
            $user_id = Auth::user()->id;

            User::find($user_id)->update(['group_id' => $request->group_id]);
            return Helper::success([], 'Group change successfully');
        } catch (Exception $e) {
            return Helper::fail([], $e->getMessage());
        }
    }
    public function GetCategory()
    {
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
        $data = $request->json()->all();
        $catalog_data = Customer::where('default', '1')->first();
        if (!$catalog_data) {
            prx('Please select company');
        }

        $return_data['catalog_data'] = $catalog_data;
        $cat_sql = StockManagement::groupBy('category');
        if (isset($data['ids'])) {
            $ids = $data['ids'];
            $cat_sql = $cat_sql->whereIn('id', $ids);
        }

        $cat_ids = $cat_sql->get('category')->pluck('category')->toArray();
        $product = MerchantCategory::whereIn('id', $cat_ids);

        if (isset($data['ids'])) {
            $product = $product->with(['product.productImages', 'product' =>  function ($query) use ($ids) {
                $query->whereIn('id', $ids);
            }]);
        } else {
            $product = $product->with(['product', 'product.productImages']);
        }
        $product = $product->get();
        $return_data['product'] = $product;

        return Helper::success($return_data, 'Catalogue Loaded Successfully');
    }

    public function GetVendors()
    {
        $data = Quotation::get();
        return Helper::success($data, 'Vendor load successfully');
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
        try {
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

            $quotation = Quotation::findOrFail($data['id']);
            $quotation->update(['companyname' => $data['companyname'], 'address' => $data['address'], 'notes' => $data['notes'], 'gst' => $data['gst'],]);

            return Helper::success(null, 'Vendor updated successfully');
        } catch (Exception $e) {
            return Helper::fail([], $e->getMessage());
        }
    }

    public function DeleteVendor(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            return Helper::fail($validator->errors(), Helper::error_parse($validator->errors()));
        }
        $quotation = Quotation::find($request->id);
        if ($quotation) {
            $quotation->delete();
        }
        return Helper::success(null, 'Vendor deleted successfully');
    }

    public function GetProducts()
    {
        $stock = StockManagement::with(['productDimensionData', 'vendor.quotation'])->get();
        return Helper::success($stock);
    }
    public function StoreProduct(Request $request)
    {
        try {
            $group_id = Auth::user()->group_id;

            $data = $request->json()->all();

            $validator = Validator::make($data, [
                'product_name' =>  [
                    'required',
                    Rule::unique('stock_management', 'product_name')->where(function ($query) use ($group_id) {
                        return $query->where('group_id', $group_id);
                    })->ignore($request->input('id'))
                ],
                'partno' => 'required',
                'category' => 'required',
                'product_company' => 'required',
                'product_size' => 'required|integer',
                'product_price' => 'required|integer',
                'specification' => 'required',
                'notes' => 'required',
            ]);

            if ($validator->fails()) {
                return Helper::fail($validator->errors(), "Enter all require param.");
            }
            $date_time = GetDateTime();

            $stock_data = (object) $data;

            $product_id = StockManagement::insertGetId(
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
                    'created_at' => $date_time,
                    'updated_at' => $date_time
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

            if (isset($stock_data->dimensions)) {

                foreach ($stock_data->dimensions as $dimensions) {
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
                $vendor_data = [
                    'product_id' => $product_id, 'quotation_id' => $vendor['id'], 'created_at' => $date_time,
                    'updated_at' => $date_time
                ];
                StockVendor::insert($vendor_data);
            }

            return Helper::success([], 'Product store successfully');
        } catch (\Exception $e) {
            return Helper::fail([], $e->getMessage());
        }
    }
    public function EditProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            return Helper::fail($validator->errors(), Helper::error_parse($validator->errors()));
        }
        $product = StockManagement::with(['productDimensionData', 'vendor.quotation'])->find($request->id);
        if (!$product) {
            return Helper::fail(null, 'Product not found');
        }
        return Helper::success($product, 'Product load successfully');
    }

    public function UpdateProduct(Request $request)
    {
        try {
            $group_id = Auth::user()->group_id;

            $data = $request->json()->all();
            $validator = Validator::make($data, [
                'id' => 'required',
                'product_name' =>  [
                    'required',
                    Rule::unique('stock_management', 'product_name')->where(function ($query) use ($group_id) {
                        return $query->where('group_id', $group_id);
                    })->ignore($data['id'])
                ],
                'partno' => 'required',
                'category' => 'required',
                'product_company' => 'required',
                'product_size' => 'required|integer',
                'product_price' => 'required|integer',
                'specification' => 'required',
                'notes' => 'required',
            ]);

            if ($validator->fails()) {
                return Helper::fail($validator->errors(), "Enter all require param.");
            }
            $date_time = GetDateTime();

            $stock_data = (object) $data;
            $product_id = $data['id'];

            $stock = StockManagement::find($product_id);
            if (!$stock) {
                return Helper::fail([], "Invalid product id.");
            }
            $arr =
                [
                    'product_name' => $stock_data->product_name,
                    'partno' => $stock_data->partno,
                    'product_company' => $stock_data->product_company,
                    'product_size' => $stock_data->product_size,
                    'product_price' => $stock_data->product_price,
                    'category' => $stock_data->category,
                    'notes' => $stock_data->notes,
                    'specification' => $stock_data->specification,
                    'updated_at' => $date_time
                ];
            $stock->update($arr);

            ProductDimension::where('product_id', $product_id)->delete();

            if (isset($stock_data->dimensions)) {

                foreach ($stock_data->dimensions as $dimensions) {
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
            StockVendor::where('product_id', $product_id)->delete();

            $vendor_data = [];
            foreach ($stock_data->vendors as $vendor) {
                $vendor_data = [
                    'product_id' => $product_id, 'quotation_id' => $vendor['id'], 'created_at' => $date_time,
                    'updated_at' => $date_time
                ];
                StockVendor::create($vendor_data);
            }
            return Helper::success([], 'Product updated successfully');
        } catch (\Exception $e) {
            return Helper::fail([], $e->getMessage());
        }
    }


    public function DeleteProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            return Helper::fail($validator->errors(), Helper::error_parse($validator->errors()));
        }
        $quotation = StockManagement::find($request->id);
        if ($quotation) {
            $quotation->delete();
        }
        return Helper::success(null, 'Product deleted successfully');
    }
}
