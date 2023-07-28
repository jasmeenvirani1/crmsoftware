<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inward extends Model
{
    use HasFactory;
    public $table = "inward_quantity";
    public $timestamps= true;
    protected $fillable = [
        'stock_id',
        'inward_qty',
        'vendor_name',
        'product_price',
        'po_no',
        'outward_qty',
        'balanced_qty',
        'lpm_no',
        'project_name',
        'notes',
        'created_at',
        'updated_at',
    ];
}
