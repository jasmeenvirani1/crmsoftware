<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientAndSalesImage extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $table = "client_and_sales_images";

}
