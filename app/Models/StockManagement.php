<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class StockManagement extends Model
{
    use HasFactory;
    public $table = "stock_management";
    public $timestamps = true;
    protected $fillable = [
        'product_name',
        'product_company',
        'product_size',
        'product_price',
        'usd_price',
        'product_dimension',
        'inward_qty',
        'images',
        'partno',
        'category',
        'vendorimage',
        'clientimage',
        'specification',
        'notes',
        'outward_qty',
        'created_at',
        'updated_at',
    ];

    // protected $appends = ['clientimage_url'];


    public function getProductDimensionAttribute($value)
    {
        try {
            return json_decode($value);
        } catch (\Exception $e) {
            return $value;
        }
    }

    public function getImagesAttribute($value)
    {
        try {
            return json_decode($value);
        } catch (\Exception $e) {
            return $value;
        }
    }

    public function getVendorImageAttribute($value)
    {
        try {
            return json_decode($value);
        } catch (\Exception $e) {
            return $value;
        }
    }

    public function getClientImageAttribute($value)
    {
        try {
            return json_decode($value);
        } catch (\Exception $e) {
            return $value;
        }
    }

    public function balanced()
    {
        return $this->belongsTo(Balanced::class, 'id', 'stock_id');
    }
    public function productImages()
    {
        return $this->hasMany(ProductImage::class,'product_id','id');
    }
    public function vendorImages()
    {
        return $this->hasMany(VendorImage::class,'product_id','id');
    }
    public function clientImages()
    {
        return $this->hasMany(ClientAndSalesImage::class,'product_id','id');
    }

    // public function getClientImageUrlAttribute($value) {
    //     return Storage::disk('public')->url('client_image/' . $this->clientimage);
    // }
}
