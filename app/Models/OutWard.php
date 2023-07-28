<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutWard extends Model
{
    use HasFactory;
    public $table = "outward_quantity";
    public $timestamps= true;
    protected $fillable = [
        'stock_id',
        'outward_qty',
        'created_at',
        'updated_at',
    ];
}
