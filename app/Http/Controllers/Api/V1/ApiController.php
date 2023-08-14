<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Models\MerchantCategory;
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
            ]);

            if ($validator->fails()) {
                return Helper::fail([], Helper::error_parse($validator->errors()));
            }

            $model = new MerchantCategory($group_id);

            $model = $model->find($request->id);
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
}
