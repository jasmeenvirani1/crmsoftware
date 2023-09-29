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
        'notes',
        'created_at',
        'default',
        'logo',
        'msme_certificate',
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
    public function extraImage()
    {
        return $this->hasMany(CustomerExtraImage::class, 'customer_id', 'id');
    }
}
