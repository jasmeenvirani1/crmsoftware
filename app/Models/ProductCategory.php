<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'product_id',
        'categories_id',
        'deleted_at',
        'created_at',
        'updated_at',
    ];
    public function product()
    {
        return $this->hasOne(StockManagement::class, 'id', 'product_id');
    }
    public function GetCategoriesName()
    {
        return $this->hasOne(MerchantCategory::class, 'id', 'categories_id');
    }
}
