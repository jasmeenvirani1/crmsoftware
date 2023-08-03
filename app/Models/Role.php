<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'name',
        'key',
        'email_id',
        'permissions',
    ];
}
