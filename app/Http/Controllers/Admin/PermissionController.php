<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        return view('admin.permission.index',['title' => "Permission"]);
    }

}
