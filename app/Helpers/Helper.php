<?php

namespace App\Helpers;

use Request;
use Exception;
use URL;
use DB;
use App\Models\User;
use App\Model\Notification;

class Helper {

    public static function res($data, $msg, $code, $extra_msg = "") {
        $response = [
            'status' => $code == 200 ? true : false,
            'code' => $code,
            'msg' => $msg,
            'extra_msg' => $extra_msg,
            'version' => env('VERSION', '1.0.0'),
            'data' => $data
        ];
        return response($response, $code);
    }

    public static function success($data = [], $msg = 'Success', $code = 200, $extra_msg = "") {
        return Helper::res($data, $msg, $code, $extra_msg);
    }

    public static function fail($data = [], $msg = "Some thing wen't wrong!", $code = 400) {
        return Helper::res($data, $msg, $code);
    }

    public static function success_web($data = [], $msg = 'Success', $code = 200) {
        return Helper::res($data, $msg, $code);
    }

    public static function fail_web($data = [], $msg = "Some thing wen't wrong!", $code = 400) {
        return Helper::res($data, $msg, $code);
    }

    public static function error_parse($msg) {
        foreach ($msg->toArray() as $key => $value) {
            foreach ($value as $ekey => $evalue) {
                return $evalue;
            }
        }
    }

    public static function baseUploadPath() {
        return storage_path('app/public/');
    }

    public static function pofileFileUploadPath() {
        return storage_path('app/public/user/profile/');
    }

    public static function deliveryFileUploadPath() {
        return storage_path('app/public/delivery/');
    }

    public static function displayImagePath() {
        return URL::to('/') . '/storage/user/profile/';
    }

    # admin profile pictures

    public static function profileFileUploadPath() {
        return storage_path('app/public/profile_pcitures/');
    }

    /* For Display Image */

    public static function displayProfilePath() {
        return URL::to('/') . '/storage/profile_pcitures/';
    }

}
