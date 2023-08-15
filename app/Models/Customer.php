<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class Customer extends Model
{
    use HasFactory;
    use Notifiable;
    public $group_id;

    public function __construct($group_id = null)
    {
        if (isset(Auth::user()->group_id)) {
            $this->group_id = Auth::user()->group_id;
        } else {
            $this->group_id = $group_id;
        }
    }
    public $table = "customer";
    public $timestamps = true;
    protected $fillable = [
        'name',
        'email',
        'phonenumber',
        'address',
        'gst',
        'cheque',
        'pancard',
        'created_at',
        'default',
        'logo',
        'msme_certificate',
        'updated_at',
    ];

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

        // Add the default 'role' condition to the query
        $query->where('group_id', $this->group_id);

        return $query;
    }
}
