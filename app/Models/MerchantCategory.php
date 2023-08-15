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

    public $table = "merchant_categories";
    public $timestamps = true;
    public $group_id;
    protected $fillable = [
        'name',
        'group_id',
        'created_at',
        'updated_at',
    ];

    public function __construct($group_id = null)
    {
        if (isset(Auth::user()->group_id)) {
            $this->group_id = Auth::user()->group_id;
        } else {
            $this->group_id = $group_id;
        }
    }
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

    public function setImagesAttribute($value)
    {
        $this->attributes['images'] = json_encode($value);
    }

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->group_id = $this->group_id;
        });
    }
    public function newQuery($excludeDeleted = true)
    {
        // Call the parent method to get the base query builder
        $query = parent::newQuery($excludeDeleted);
        if ($this->group_id != null) {
            // Add the default 'role' condition to the query
            $query->where('group_id', $this->group_id);
        }
        return $query;
    }
}
