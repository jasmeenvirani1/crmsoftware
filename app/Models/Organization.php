<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;
    public $table = "organization";
    public $timestamps= true;
    protected $fillable = [
        'organization_name',
        'email',
        'website',
        'gst_no',
        'pancad_no',
        'bank_name',
        'account_no',
        'ifsc_code',
        'branch_name',
        'contact_no',
        'full_address',
        'pincode',
        'logo',
        'created_at',
        'updated_at',
    ];
    public function getContactNoAttribute($value)
    {
        try {
            return json_decode($value);
        } catch (\Exception $e) {
            return $value;
        }
    }
    public function getEmailAttribute($value)
    {
        try {
            return json_decode($value);
        } catch (\Exception $e) {
            return $value;
        }
    }
}
