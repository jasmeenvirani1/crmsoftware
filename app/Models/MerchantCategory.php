<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class MerchantCategory extends Model
{

    use HasFactory,
        SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    protected $fillable = [
        'id',
        'name',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    public function setImagesAttribute($value)
    {
        $this->attributes['images'] = json_encode($value);
    }
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
    public function product()
    {
        return $this->hasMany(StockManagement::class, 'category', 'id');
    }
}
