<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balanced extends Model
{
    use HasFactory;
    public $table = "balanced";
    public $timestamps= true;
    protected $fillable = [
        'stock_id',
        'balanced_qty',
        'created_at',
        'updated_at',
    ];
}
