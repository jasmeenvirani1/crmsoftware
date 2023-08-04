<?php

use Illuminate\Support\Facades\Auth;

function prx($data)
{
    echo "<pre>";
    print_r($data);
    die;
}
function uploadImage($file, $path)
{
    try {
        $destinationPath = public_path($path);
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $path . '/' . $filename;
        $filename = str_replace(" ", "", $filename);
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
function CheckPermissionForUser($module, $operation)
{
    return false;

    $role_data = Auth::user()->role()->first();
    prx($role);
    if ($role_data) {
        $role = json_decode($role_data->permissions);
        $role = get_object_vars();
        if (property_exists($role, $module) && in_array($operation, $role )) {

        }else{
            return false;
        }
    } else {
        return false;
    }
}
