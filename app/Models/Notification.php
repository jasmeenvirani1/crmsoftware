<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    public $table = "notification";
    public $timestamps= true;
    protected $fillable = [
        'name',
        'number',
        'message','date',
        'created_at',
        'updated_at',
    ];
}
