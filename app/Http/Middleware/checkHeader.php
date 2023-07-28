<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Validator;
use App\Helpers\Helper;

class checkHeader {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next) {
        // $validator = Validator::make($request->headers->all(), [
        //             'api-key' => 'required',
        // ]);
        // if ($validator->fails()) {
        //     return Helper::fail([], Helper::error_parse($validator->errors()));
        // }
        $api_key = $request->header('api-key');
        $original_api_key = env('API_KEY', 'pASDASfszTddANGLN8989561HKzaXoelFo1Gs');

        // if ($original_api_key == $api_key) {
        //     return Helper::fail([], 'api-key not valid');
        // }
        return $next($request);
    }

}
