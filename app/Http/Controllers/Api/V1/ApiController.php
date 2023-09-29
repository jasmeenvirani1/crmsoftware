<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Models\ClientAndSalesImage;
use App\Models\Customer;
use App\Models\Group;
use App\Models\MerchantCategory;
use App\Models\ProductCategory;
use App\Models\ProductDimension;
use App\Models\ProductImage;
use App\Models\Quotation;
use App\Models\QuotationDetails;
use App\Models\StockManagement;
use App\Models\StockVendor;
use App\Models\User;
use App\Models\VendorImage;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PDF;
use Illuminate\Support\Facades\File;
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
        $customer = Customer::with(['extraImage'])->get();
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
        $cat_sql = ProductCategory::groupBy('categories_id');
        if (isset($data['ids'])) {
            $product_ids_arr = $data['ids'];
        } else {
            $product_ids_arr = StockManagement::pluck('id')->toArray();
        }
        $un_cat_data = StockManagement::join('product_categories', 'product_categories.product_id', '!=', 'stock_management.id')
            ->whereIn('product_categories.product_id', $product_ids_arr)
            ->get()
            ->toArray();

        $cat_ids = $cat_sql
            ->whereIn('product_id', $product_ids_arr)
            ->get('categories_id')
            ->pluck('categories_id')
            ->toArray();

        $product = MerchantCategory::whereIn('id', $cat_ids);

        if (isset($data['ids'])) {
            $product = $product->with([
                'productIds' => function ($query) use ($product_ids_arr) {
                    $query->whereIn('product_id', $product_ids_arr)->with('product.productImages');
                },
            ]);
        } else {
            $product = $product->with(['productIds.product.productImages']);
        }

        $product = $product->get();
        view()->share('product_data', $product);
        view()->share('catalog_data', $catalog_data);

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('admin.catalog.pdf_template_api', ['product_data' => $product, 'catalog_data' => $catalog_data]);

        $temporaryPath = public_path('catalog/');
        $filename = rand(0, 999999) . time() . '.pdf';
        if (!is_dir($temporaryPath)) {
            File::makeDirectory($temporaryPath, 0777, true, true);
        }
        $pdf->save($temporaryPath . '/' . $filename);
        $final_path = url('/') . '/catalog/' . $filename;
        $final_return_data['url'] = $final_path;
        return Helper::success($final_return_data, 'Catalogue Loaded Successfully');
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
        return Helper::success($vendor, 'Vendor load successfully');
    }

    public function StoreVendor(Request $request)
    {
        $group_id = Auth::user()->group_id;
        $data = $request->json()->all();

        $rules_latitude = '/^[-]?((([0-8]?[0-9])\.(\d+))|(90(\.0+)?))$/';
        $rules_longitude = '/^[-]?((([0]?[0-9]?[0-9])\.(\d+))|([1][0-7][0-9])\.(\d+)|([1][0-8][0])\.(\d+)|([1][0-8])\.(\d+)|([1][0-7])\.(\d+)|180(\.0+)?)$/';

        $validator = Validator::make($data, [
            'companyname' => [
                'required',
                Rule::unique('quotation')->where(function ($query) use ($group_id) {
                    return $query->where('group_id', $group_id);
                })
            ],
            'gst' => [
                'required', 'string', 'size:15',
                Rule::unique('quotation', 'gst')->where(function ($query) use ($data, $group_id) {
                    return $query->where('gst', $data['gst'])->where('group_id', $group_id);
                })
            ],
            'notes' => ['required'],
            'address' => ['required'],

            'registered_address' => 'required',
            'registered_address_latitude' => ['nullable', 'regex:' . $rules_latitude],
            'registered_address_longitude' => ['nullable', 'regex:' . $rules_longitude],

            'plant_address' => 'required',
            'plant_address_latitude' => ['nullable', 'regex:' . $rules_latitude],
            'plant_address_longitude' => ['nullable', 'regex:' . $rules_longitude],

            'billing_address' => 'required',
            'billing_address_latitude' => ['nullable', 'regex:' . $rules_latitude],
            'billing_address_longitude' => ['nullable', 'regex:' . $rules_longitude],
        ]);
        if ($validator->fails()) {
            return Helper::fail($validator->errors(), Helper::error_parse($validator->errors()));
        }

        $insertData = [
            'companyname' => $data['companyname'],
            'notes' => $data['notes'],
            'gst' => $data['gst'],
            'address' => $data['address'],

            'registered_address' => $data['registered_address'],
            'registered_address_latitude' => $data['registered_address_latitude'],
            'registered_address_longitude' => $data['registered_address_longitude'],

            'plant_address' => $data['plant_address'],
            'plant_address_latitude' => $data['plant_address_latitude'],
            'plant_address_longitude' => $data['plant_address_longitude'],

            'billing_address' => $data['billing_address'],
            'billing_address_latitude' => $data['billing_address_latitude'],
            'billing_address_longitude' => $data['billing_address_longitude'],

            'group_id' => $group_id
        ];

        $quotation_id = Quotation::insertGetId($insertData);
        if (isset($data['contact_details'])) {
            $final_contact_data = [];
            foreach ($data['contact_details'] as $contact_details) {
                $count = QuotationDetails::where(function ($query) use ($contact_details) {
                    $query->where('name', $contact_details['name'])
                        ->orWhere('phone', $contact_details['phone'])
                        ->orWhere('email', $contact_details['email']);
                })->count();
                if ($count <= 0) {
                    $contact_details['quotation_id'] = $quotation_id;
                    $contact_details['group_id'] = $group_id;
                    $contact_details['created_at'] = $contact_details['updated_at'] = GetDateTime();
                    $final_contact_data[] = $contact_details;
                }
            }
            QuotationDetails::insert($final_contact_data);
        }

        return Helper::success(null, 'Vendor store successfully');
    }

    public function UpdateVendor(Request $request)
    {
        try {
            $group_id = Auth::user()->group_id;
            $data = $request->json()->all();

            $rules_latitude = '/^[-]?((([0-8]?[0-9])\.(\d+))|(90(\.0+)?))$/';
            $rules_longitude = '/^[-]?((([0]?[0-9]?[0-9])\.(\d+))|([1][0-7][0-9])\.(\d+)|([1][0-8][0])\.(\d+)|([1][0-8])\.(\d+)|([1][0-7])\.(\d+)|180(\.0+)?)$/';

            $validator = Validator::make($data, [
                'id' => ['required'],
                'companyname' => [
                    'required',
                    Rule::unique('quotation')->where(function ($query) use ($group_id) {
                        return $query->where('group_id', $group_id);
                    })->ignore($data['id'])
                ],
                'gst' => [
                    'required', 'string', 'size:15',
                    Rule::unique('quotation', 'gst')->where(function ($query) use ($data, $group_id) {
                        return $query->where('gst', $data['gst'])->where('group_id', $group_id);
                    })->ignore($data['id'])
                ],
                'notes' => ['required'],
                'address' => ['required'],
                'registered_address' => 'required',
                'registered_address_latitude' => ['nullable', 'regex:' . $rules_latitude],
                'registered_address_longitude' => ['nullable', 'regex:' . $rules_longitude],

                'plant_address' => 'required',
                'plant_address_latitude' => ['nullable', 'regex:' . $rules_latitude],
                'plant_address_longitude' => ['nullable', 'regex:' . $rules_longitude],

                'billing_address' => 'required',
                'billing_address_latitude' => ['nullable', 'regex:' . $rules_latitude],
                'billing_address_longitude' => ['nullable', 'regex:' . $rules_longitude],
            ]);
            if ($validator->fails()) {
                return Helper::fail($validator->errors(), Helper::error_parse($validator->errors()));
            }

            $update_data = [
                'companyname' => $data['companyname'],
                'notes' => $data['notes'],
                'gst' => $data['gst'],
                'address' => $data['address'],

                'registered_address' => $data['registered_address'],
                'registered_address_latitude' => $data['registered_address_latitude'],
                'registered_address_longitude' => $data['registered_address_longitude'],

                'plant_address' => $data['plant_address'],
                'plant_address_latitude' => $data['plant_address_latitude'],
                'plant_address_longitude' => $data['plant_address_longitude'],

                'billing_address' => $data['billing_address'],
                'billing_address_latitude' => $data['billing_address_latitude'],
                'billing_address_longitude' => $data['billing_address_longitude'],
            ];

            $quotation_id = $data['id'];

            $quotation = Quotation::findOrFail($quotation_id);
            $quotation->update($update_data);

            if (isset($data['contact_details'])) {

                QuotationDetails::where('quotation_id', $quotation_id)->delete();

                $final_contact_data = [];

                foreach ($data['contact_details'] as $contact_details) {
                    $count = QuotationDetails::where(function ($query) use ($contact_details) {
                        $query->where('name', $contact_details['name'])
                            ->orWhere('phone', $contact_details['phone'])
                            ->orWhere('email', $contact_details['email']);
                    })->count();

                    if ($count <= 0) {
                        $contact_details['quotation_id'] = $quotation_id;
                        $contact_details['group_id'] = $group_id;
                        $contact_details['created_at'] = $contact_details['updated_at'] = GetDateTime();
                        $final_contact_data[] = $contact_details;
                    }
                }

                QuotationDetails::insert($final_contact_data);
            }

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
        $stock = StockManagement::with(['productImages', 'vendorImages', 'clientImages', 'productDimensionData', 'vendor.quotation', 'categories.GetCategoriesName'])->get();
        return Helper::success($stock);
    }
    public function StoreProduct(Request $request)
    {
        try {
            $group_id = Auth::user()->group_id;
            $validator = Validator::make($request->all(), [
                'product_name' =>  [
                    'required',
                    Rule::unique('stock_management', 'product_name')->where(function ($query) use ($group_id) {
                        return $query->where('group_id', $group_id);
                    })->ignore($request->input('id'))
                ],
                'category' => 'required',
                'product_price' => 'required',
                'product_images' => 'required|mimes:jpeg,png,jpg,gif'
            ]);

            if ($validator->fails()) {
                return Helper::fail($validator->errors(), "Enter all require param.");
            }

            $date_time = GetDateTime();

            $stock_data =  $request;
            $arr =    [
                'product_name' => $stock_data->product_name,
                'partno' => $stock_data->partno,
                'product_company' => $stock_data->product_company,
                'product_price' => $stock_data->product_price,
                'usd_price' => Helper::ConvertInrToUsd($stock_data->product_price),
                'notes' => $stock_data->notes,
                'specification' => $stock_data->specification,
                'group_id' => $group_id,
                'minimum_order_quantity' => $stock_data->minimum_order_quantity,
                'corporate_price' => $stock_data->corporate_price,
                'retail_price' => $stock_data->retail_price,
                'dealer_price' => $stock_data->dealer_price,
                'created_at' => $date_time,
                'updated_at' => $date_time,
            ];
            $product_id = StockManagement::insertGetId($arr);

            if (($request->product_images) != null) {
                $files = $this->addImages('product_images', $product_id, $request->product_images);
                ProductImage::insert($files);
            }
            if (($request->vendor_images) != null) {
                $files = $this->addImages('vendor_images', $product_id, $request->vendor_images);
                VendorImage::insert($files);
            }

            if (($request->client_images) != null) {
                $files = $this->addImages('client_images', $product_id, $request->client_images);
                ClientAndSalesImage::insert($files);
            }

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
            if (request()->has('vendors')) {
                $vendor_data = [];
                foreach ($stock_data->vendors as $vendor) {
                    $vendor_data[] = [
                        'product_id' => $product_id, 'quotation_id' => $vendor['quotation_id'], 'price' => $vendor['price'], 'created_at' => $date_time,
                        'updated_at' => $date_time
                    ];
                }
                StockVendor::insert($vendor_data);
            }

            if (request()->has('category') && count($request->category) > 0) {
                $category_data = [];
                foreach ($request->category as $category) {
                    $category_data[] = ['product_id' => $product_id, 'categories_id' => $category];
                }
                ProductCategory::insert($category_data);
            }

            return Helper::success([], 'Product store successfully');
        } catch (Exception $e) {
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
        $product = StockManagement::with(['productImages', 'vendorImages', 'clientImages', 'productDimensionData', 'vendor.quotation', 'categories.GetCategoriesName'])->find($request->id);
        if (!$product) {
            return Helper::fail(null, 'Product not found');
        }
        return Helper::success($product, 'Product load successfully');
    }

    public function UpdateProduct(Request $request)
    {
        try {
            $group_id = Auth::user()->group_id;

            $validator = Validator::make($request->all(), [
                'id' => 'required',
                'product_name' =>  [
                    'required',
                    Rule::unique('stock_management', 'product_name')->where(function ($query) use ($group_id) {
                        return $query->where('group_id', $group_id);
                    })->ignore($request->input('id'))
                ],
                'category' => 'required',
                'product_price' => 'required'
            ]);

            if ($validator->fails()) {
                return Helper::fail($validator->errors(), "Enter all require param.");
            }
            $date_time = GetDateTime();

            $stock_data =  $request;
            $product_id = $request->id;
            $stock = StockManagement::find($product_id);
            if (!$stock) {
                return Helper::fail([], 'Product not found.');
            }

            $arr = [
                'product_name' => $stock_data->product_name,
                'partno' => $stock_data->partno,
                'product_company' => $stock_data->product_company,
                'product_price' => $stock_data->product_price,
                'usd_price' => Helper::ConvertInrToUsd($stock_data->product_price),
                'category' => $stock_data->category,
                'notes' => $stock_data->notes,
                'specification' => $stock_data->specification,
                'minimum_order_quantity' => $stock_data->minimum_order_quantity,
                'corporate_price' => $stock_data->corporate_price,
                'retail_price' => $stock_data->retail_price,
                'dealer_price' => $stock_data->dealer_price,
                'created_at' => $date_time,
                'updated_at' => $date_time,
            ];
            $stock->update($arr);

            if (($request->product_images) != null) {
                $files = $this->addImages('product_images', $product_id, $request->product_images);
                ProductImage::insert($files);
            }
            if (($request->vendor_images) != null) {
                $files = $this->addImages('vendor_images', $product_id, $request->vendor_images);
                VendorImage::insert($files);
            }

            if (($request->client_images) != null) {
                $files = $this->addImages('client_images', $product_id, $request->client_images);
                ClientAndSalesImage::insert($files);
            }

            if (isset($stock_data->dimensions)) {
                ProductDimension::where('product_id', $product_id)->delete();

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

            if (request()->has('vendors')) {
                StockVendor::where('product_id', $product_id)->delete();

                $vendor_data = [];
                foreach ($stock_data->vendors as $vendor) {
                    $vendor_data[] = [
                        'product_id' => $product_id, 'quotation_id' => $vendor['quotation_id'], 'price' => $vendor['price'], 'created_at' => $date_time,
                        'updated_at' => $date_time
                    ];
                }
                StockVendor::insert($vendor_data);
            }
            if (request()->has('category') && count($request->category) > 0) {
                ProductCategory::where('product_id', $product_id)->delete();

                $category_data = [];
                foreach ($request->category as $category) {
                    $category_data[] = ['product_id' => $product_id, 'categories_id' => $category];
                }
                ProductCategory::insert($category_data);
            }
            return Helper::success([], 'Product updated successfully');
        } catch (Exception $e) {
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

    public  function DeleteProductImage(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'type' => 'required|in:product_images,vendor_images,client_and_sales_images',
        ]);

        if ($validator->fails()) {
            return Helper::fail($validator->errors(), Helper::error_parse($validator->errors()));
        }

        DB::table($request->type)->where('id', $request->id)->update(['deleted_at' => now()]);

        return Helper::success(null, 'Image deleted successfully');
    }
    public  function GetProfile()
    {
        return Helper::success(Auth::user(), 'Profile deleted successfully');
    }
    public  function UpdateProfile(Request $request)
    {
        $input['name'] = $request->name;
        $input['mobile_number'] = $request->mobile_number;
        $rules = [
            'name' => 'required',
            'mobile_number' => 'required|regex:/^[0-9]{10}$/',
        ];
        if (request()->has('password')) {
            $rules['password'] = 'required|min:4';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Helper::fail($validator->errors(), Helper::error_parse($validator->errors()));
        }
        $input = [
            'name' => $request->name,
            'mobile_number' => $request->mobile_number,
            'updated_at' => GetDateTime()
        ];
        if (request()->has('password')) {
            $input['password'] = Hash::make($request->password);
        }
        $model = User::find(Auth::user()->id)->update($input);
        return Helper::success([], 'Profile updated successfully');
    }

    public function GetCategoryProduct($category_id)
    {
        $data = StockManagement::with(['productImages', 'vendorImages', 'clientImages', 'productDimensionData', 'vendor.quotation', 'categories.GetCategoriesName'])
            ->join('product_categories', 'product_categories.product_id', 'stock_management.id')
            ->where('product_categories.categories_id', $category_id)->get('stock_management.*');
        return Helper::success($data, 'Products load successfully');
    }
}
