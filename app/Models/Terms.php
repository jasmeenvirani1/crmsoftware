<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Terms extends Model
{
    use HasFactory;
    public $table = "terms";
    public $timestamps= true;
    protected $fillable = [
        'quotation_item_id',
        'title',
        'description',
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
     public function getDescriptionAttribute($value)
    {
        try {
            return json_decode($value);
        } catch (\Exception $e) {
            return $value;
        }
    }
}
