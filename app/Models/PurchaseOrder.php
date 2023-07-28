<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class PurchaseOrder extends Model
{
    use HasFactory;
    use Notifiable;
    public $table = "purchase_order";
    public $timestamps= true;
    protected $fillable = [
        'organization_name',
        'ship_to',
        'lpm_no',
        'po_no',
        'po_no_of',
        'revision_no',
        'project_credentials',
        'vendor_name',
        'priority',
        'product_name',
        'description',
        'quantity',
        'unit_price',
        'total_price',
        'comments',
        'delivery_date',
        'payment_terms',
        'prepared_by',
        'approved_by',
        'created_at',
        'updated_at',
    ];

    public function getProductNameAttribute($value)
    {
        try {
            return json_decode($value);
        } catch (\Exception $e) {
            return $value;
        }
    }
    public function getDescriptionAttribute($value)
    {
        try {
            return json_decode($value);
        } catch (\Exception $e) {
            return $value;
        }
    }
    public function getQuantityAttribute($value)
    {
        try {
            return json_decode($value);
        } catch (\Exception $e) {
            return $value;
        }
    }
    public function getUnitPriceAttribute($value)
    {
        try {
            return json_decode($value);
        } catch (\Exception $e) {
            return $value;
        }
    }
    public function getTotalPriceAttribute($value)
    {
        try {
            return json_decode($value);
        } catch (\Exception $e) {
            return $value;
        }
    }

    public function vendor(){
        return $this->belongsTo(Vendor::class,'vendor_name','id');
    }
    public function organization(){
        return $this->belongsTo(Organization::class,'organization_name','id');
    }
}
