<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|max:40',
                'password' => 'required',
            ]);
            if ($validator->fails()) {
                return Helper::fail([], Helper::error_parse($validator->errors()));
            }
            // $auth = Auth::attempt(['email' => request('email'), 'password' => request('password'), 'is_active' => '1']);
            // dd($auth);
            // if ($auth) {
            $user = User::where('email', '=', $request->email)->first();
            if ($user != null) {
                $success['user'] = $user;
                $success['token'] = $user->createToken('token')->accessToken;
                return Helper::success($success, 'User Login Successfully');
            } else {
                return Helper::fail([], 'Unauthorised');
            }
        } catch (\Exception $e) {
            return Helper::fail([], $e->getMessage());
        }
    }

    public function getProfileData(Request $request)
    {
        try {
            if (Auth::user()) {
                return Helper::success(Auth::user());
            } else {
                return Helper::fail([]);
            }
        } catch (\Exception $e) {
            return Helper::fail([], $e->getMessage());
        }
    }

    public function logout(Request $request)
    {
        try {
            $isUser = $request->user()->token()->revoke();
            if ($isUser) {
                return Helper::success([], 'Successfully logged out.');
            } else {
                return Helper::fail([]);
            }
        } catch (\Exception $e) {
            return Helper::fail([], $e->getMessage());
        }
    }
}
