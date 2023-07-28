<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechnicalSpecification extends Model
{
    use HasFactory;
    public $table = "technical_specification";
    public $timestamps= true;
    protected $fillable = [
        'quotation_item_id',
        'product_name',
        'external_dimension',
        'title',
        'details',
        'created_at',
        'updated_at',
    ];

     public function getTitleAttribute($value)
    {
        try {
            return json_decode($value);
        } catch (\Exception $e) {
            return $value;
        }
    }
    public function getExternalDimensionAttribute($value)
    {
        try {
            return json_decode($value);
        } catch (\Exception $e) {
            return $value;
        }
    }
     public function getDetailsAttribute($value)
    {
        try {
            return json_decode($value);
        } catch (\Exception $e) {
            return $value;
        }
    }
}
