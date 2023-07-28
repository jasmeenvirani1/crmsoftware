<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quotation;
use App\Models\Notification;
use DateTime;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class NotificationController extends Controller
{
    public function index() {
        return view('admin.notification.index', ['title' => "Notification"]);
    }

    public function show($id) {
        $date = new DateTime();
        $data12 = $date->format('Y-m-d');
        return Datatables::of(Notification::where('date','=',$data12)->orderBy('id','desc')->get())->make(true);
    }
}
