<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Validator;
use App\Helpers\Helper;
use App\Models\User;
use PHPUnit\TextUI\Help;

class checkHeader
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // $validator = Validator::make($request->headers->all(), [
        //             'api-key' => 'required',
        // ]);
        // if ($validator->fails()) {
        //     return Helper::fail([], Helper::error_parse($validator->errors()));
        // }
        if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
            $authHeader = $_SERVER['HTTP_AUTHORIZATION'];

            $token = str_replace('Bearer ', '', $authHeader);
            $api_key = $request->header('api-key');
            $original_api_key = env('API_KEY', 'pASDASfszTddANGLN8989561HKzaXoelFo1Gs');
            $users =  User::where('api_token', $token)->first();
            if ($users) {
                return $next($request);
            }else{
                return Helper::fail([], 'Invalid token');
            }
        } else {
            return Helper::fail([], 'HTTP_AUTHORIZATION not found');
        }
    }
}
