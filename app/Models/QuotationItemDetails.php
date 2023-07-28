<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationItemDetails extends Model
{
    use HasFactory;
    public $table = "quotation_item_details";
    public $timestamps= true;
    protected $fillable = [
        'quotation_id',
        'product_name',
        'i_d_height',
        'i_d_width',
        'i_d_depth',
        'e_d_height',
        'e_d_width',
        'e_d_depth',
        'h_s_code',
        'remark',
        'unit_price',
        'quantity',
        'total_price',
        'created_at',
        'updated_at',
    ];

     public function tech_specification(){
        return $this->belongsTo(TechnicalSpecification::class,'id','quotation_item_id');
   }
   public function terms(){
        return $this->belongsTo(Terms::class,'id','quotation_item_id');
   }

    public function getIDHeightAttribute($value)
    {
        try {
            return json_decode($value);
        } catch (\Exception $e) {
            return $value;
        }
    }
    public function getIDWidthAttribute($value)
    {
        try {
            return json_decode($value);
        } catch (\Exception $e) {
            return $value;
        }
    }
    public function getIDDepthAttribute($value)
    {
        try {
            return json_decode($value);
        } catch (\Exception $e) {
            return $value;
        }
    }
    public function getEDHeightAttribute($value)
    {
        try {
            return json_decode($value);
        } catch (\Exception $e) {
            return $value;
        }
    }
    public function getEDWidthAttribute($value)
    {
        try {
            return json_decode($value);
        } catch (\Exception $e) {
            return $value;
        }
    }
    public function getEDDepthAttribute($value)
    {
        try {
            return json_decode($value);
        } catch (\Exception $e) {
            return $value;
        }
    }
    public function getHSCodeAttribute($value)
    {
        try {
            return json_decode($value);
        } catch (\Exception $e) {
            return $value;
        }
    }
    public function getRemarkAttribute($value)
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
    public function getQuantityAttribute($value)
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
}
