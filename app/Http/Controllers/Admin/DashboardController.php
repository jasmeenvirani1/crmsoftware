<?php

namespace App\Http\Controllers\Admin;

use Request as Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;
use URL;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller {

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    # Display dashboard
    public function index() {
        return view('admin/dashboard/dashboard');
    }

    public function showMyProfilePage() {
        $data = User::find(Auth::user()->id);
        return view('admin.dashboard.my-profile', ['data' => $data]);
    }

    public function showUpdatePassword() {
        return view('admin.dashboard.change-password');
    }

    public function updateMyProfile(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                      //  'name' => 'required',
            ]);
            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator->errors());
            }
            $userInfo = User::where(['id' => Auth::user()->id])->update(['name' => $request->name]);
            if ($userInfo) {
                session()->flash('success', 'Your profile has been updated successfully.');
            } else {
                session()->flash('error', 'Oops, There is some thing went wrong, Please try again.');
            }
            return redirect()->route('my-profile');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return back()->withInput();
        }
    }

    public function udpatePassword(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                        'cuurent_password' => 'required',
                        'password' => ['required'],
                        'confirm_password' => ['same:password'],
            ]);

            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator->errors());
            }

            if (!Hash::check($request->cuurent_password, auth()->user()->password)) {
                session()->flash('error', 'Your current password does not matches with password you provided. Please try agian.');
                return redirect()->route('change-password');
            }

            $data = User::find(Auth::user()->id);
            $data->password = bcrypt($request->password);
            $data->save();

            session()->flash('success', 'Password changed successfully');
            return redirect()->route('change-password');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->route('change-password')->withInput();
        }
    }

}
