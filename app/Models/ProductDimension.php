<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductDimension extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'product_id',
        'dimension_name',
        'dimension_value',
        'quantities_value',
        'group_id',
        'created_at',
        'updated_at',
    ];

    public function setDimensionNameAttribute($value)
    {
        $this->attributes['dimension_name'] = strtolower($value);
    }

    public function setQuantitiesValueAttribute($value)
    {
        $this->attributes['quantities_value'] = strtolower($value);
    }
}
