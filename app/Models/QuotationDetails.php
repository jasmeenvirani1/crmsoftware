<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class QuotationDetails extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'quotation_id',
        'name',
        'email',
        'phone',
        'group_id',
        'created_at',
        'updated_at',
    ];


    protected static function booted()
    {
        static::creating(function ($model) {
            $model->group_id = Auth::user()->group_id;
        });
    }

    public function newQuery($excludeDeleted = true)
    {
        // Call the parent method to get the base query builder
        $query = parent::newQuery($excludeDeleted);

        // Add the default 'role' condition to the query
        $query->where('group_id', Auth::user()->group_id);

        return $query;
    }
}
