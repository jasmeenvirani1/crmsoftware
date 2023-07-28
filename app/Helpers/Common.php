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
