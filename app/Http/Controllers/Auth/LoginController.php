<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Quotation;
use App\Models\PurchaseOrder;
use App\Models\User;
use App\Models\Notification;
use DateTime;
use Validator;

class LoginController extends Controller
{
    /*
      |--------------------------------------------------------------------------
      | Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles authenticating users for the application and
      | redirecting them to your home screen. The controller uses a trait
      | to conveniently provide its functionality to your applications.
      |
     */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/admin/dashboard';

    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($request->ajax()) {
            if ($validator->fails()) {
                $response = array('status' => '411', 'msg' => 'Pass require param.', 'error_code' => 411, 'data' => $validator->errors());
            } else if (Auth::validate(['email' => $request->email, 'password' => request('password')])) {
                $response = array('status' => '200', 'msg' => 'Successfully.', 'error_code' => 200);
            } else {
                $response = array('status' => '411', 'msg' => 'Invalid Credential.', 'error_code' => 200);
            }
            return response()->json($response, $response['error_code']);
        } else {
            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator->errors());
            }

            if (Auth::attempt(['email' => $request->email, 'password' => request('password')])) {
                User::where('email', $request->email)->update(['group_id' => $request->group_id]);
                $user = Auth::user();
                if ($user->user_type != 'Admin') {
                    \Auth::logout();
                    session()->flash('error', 'You are not authorized user to login');
                    return redirect('login');
                }
                /*
              if ($user->status == '0'){
              \Auth::logout();
              session()->flash('error', config('const.inactiveMsg'));
              return redirect('login');
              } */
                return redirect()->route('dashboard');
            } else {
                session()->flash('login_error', 'Invalid Credentials');
                return redirect('login');
            }
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $group = Group::all();
        view()->share('group', $group);
        $this->middleware('guest')->except('logout');
    }

    public function logout()
    {
        \Auth::logout();
        return redirect()->route('login');
    }
    public function checkCredential()
    {
        prx(10);
    }
}
