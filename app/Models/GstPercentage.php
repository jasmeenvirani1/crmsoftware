<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GstPercentage extends Model
{
    use HasFactory;
    public $table = "gst_percentage";
    public $timestamps= true;
    protected $fillable = [
        'organization_name',
        'cgst',
        'sgst',
        'created_at',
        'updated_at',
    ];
}
