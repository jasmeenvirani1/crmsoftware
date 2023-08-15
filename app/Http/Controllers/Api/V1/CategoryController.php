<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MerchantCategory;

class CategoryController extends Controller
{

    public $user;
    function __construct()
    {
        $this->user = Helper::GetUserData();
    }

    public function store(Request $request)
    {
        
    }
}
