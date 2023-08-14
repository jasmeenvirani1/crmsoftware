<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    public $table = "role";
    public $timestamps= true;
    protected $fillable = [
        'user_name',
        'user_id',
        'email_id',
        'phone',
        'password',
        'confirm_password',
        'designation',
        'organization',
        'sales',
        'user_role',
        'notification',
        'setting',
        'inventory_management',
        'purchase',
        'customer',
        'technical_specification',
        'terms',
        'created_at',
        'updated_at',
    ];
}
