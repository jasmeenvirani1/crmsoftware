<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockVendor extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable = [
        'quotation_id',
        'product_id',
        'created_at',
        'updated_at',
    ];
    public function quotation()
    {
        return $this->hasMany(Quotation::class, 'id', 'quotation_id');
    }
}
