<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Vendor extends Model
{
    use HasFactory;
    use Notifiable;
    public $table = "vendor";
    public $timestamps= true;
    protected $fillable = [
        'name',
        'vendor_company_name',
        'vendor_gst_no',
        'vendor_pan_no',
        'email',
        'vendor_contact_no',
        'vendor_company_address',
        'vendor_company_pincode',
        'vendor_company_city',
        'vendor_company_state',
        'vendor_company_country',
        'created_at',
        'updated_at',
    ];
}
