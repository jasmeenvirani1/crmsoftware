<?php

use Illuminate\Support\Facades\Auth;

use App\Models\MerchantCategory;

function prx($data)
{
    echo '<pre>';
    print_r($data);
    die();
}
function uploadImage($file, $path)
{
    try {
        $destinationPath = public_path($path);
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $path . '/' . $filename;
        $filename = str_replace(' ', '', $filename);
        $file->move($destinationPath, $filename);
        return $filename;
    } catch (Exception $ex) {
        return $ex->getMessage();
    }
}
function AddDateTime($data, $action = 'store')
{
    $data = $data->except('_token');
    $time = GetDateTime();
    $data['updated_at'] = $time;
    if ($action == 'store') {
        $data['created_at'] = $time;
    }
    return $data;
}
function GetDateTime()
{
    $date_time = date('Y-m-d H:i:s');
    return $date_time;
}

function GetCategoryName($category_id)
{
    $query = MerchantCategory::where('id', $category_id)->first();
    if ($query) {
        $name = $query->name;
    } else {
        $name == '';
    }
    return $name;
}

function CheckPermissionForUser($module, $operation)
{
    $role_data = Auth::user()
        ->role()
        ->first();
    if ($role_data) {
        $role = json_decode($role_data->permissions);
        if (property_exists($role, $module) && in_array($operation, $role->$module)) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}
