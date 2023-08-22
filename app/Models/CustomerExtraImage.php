<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerExtraImage extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'customer_id',
        'image',
        'updated_at',
    ];
}
