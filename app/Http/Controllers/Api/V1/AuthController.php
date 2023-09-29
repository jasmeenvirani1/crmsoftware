<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
                return Helper::fail($validator->errors());
            }
            $user = User::where('email', '=', $request->email)->first();
            if ($user != null) {
                if (Hash::check($request->password, $user->password)) {
                    $success['user'] = $user;
                    $success['token'] = $token = $user->createToken('token')->accessToken;
                    $model = User::find($user->id)->update(['api_token' => $token]);
                    if ($model) {
                        return Helper::success($success, 'User Login Successfully');
                    }
                    return Helper::fail([], 'Something went wrong');
                } else {
                    return Helper::fail([], 'Invalid password');
                }
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
