<?php
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
