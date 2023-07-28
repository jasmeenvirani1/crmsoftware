<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;
use App\User;
use Crypt;
use App\Password_Resets;
use Carbon\Carbon;
use DB;
use Hash;




class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;


    # forgot password functionality (Send and email)
    public function forgotPasswordSendEmail(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);        

        if($validator->fails()) {
            return back()->withInput()->withErrors($validator->errors());
        }

        $user = User::where('email',$request->email)->first();

        if(!$user){
            session()->flash('fortgot_email_not_found', trans('email_common.email_not_exist'));
            return redirect('password/reset'); 
        }

        $token = Crypt::encryptString($request->email);

        Password_Resets::updateOrCreate(
            [
                'email' => $request->email,
            ], [
        'email' => $request->email,
        'token' => $token,
        'created_at' => Carbon::now()
        ])->forgotLink($token, $request->email);
        
        session()->flash('reset_link_sucess', trans('email_common.forgot_reset_link_msg'));
        return redirect('/login'); 
    }

    # show reset password form. 
    public function showPasswordResetForm($token,$isMobile=''){

        $tokenData = DB::table('password_resets')->where('token', $token)->first();        
        if ( !$tokenData ){                         
            session()->flash('invalid_reset_url', trans('email_common.invalid_reset_url'));
            return redirect()->to('/login');
        }
        return view('auth.passwords.reset',array('token'=>$token));
    }



    # update password and token 
    public function resetPassword(Request $request) {

        $password = $request->password;        
        $tokenData = DB::table('password_resets') ->where('token', $request->token)->first();        

        $user = User::where('email', $tokenData->email)->first();        

        if ( !$user ) {
            session()->flash('login_error', trans('email_common.invalid_email'));
            return redirect()->to('password/reset');
        }

        $user->password = Hash::make($password);
        $user->update();        
        DB::table('password_resets')->where('email', $user->email)->delete();    
        
        session()->flash('password_updated', trans('email_common.password_reset'));
        return redirect()->to('/login');                   
    }



}
