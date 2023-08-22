<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class Quotation extends Model
{
    use HasFactory;
    use Notifiable;

    public $table = "quotation";
    public $timestamps = true;
    protected $fillable = [
        'companyname',
        'personname',
        'phonenumber',
        'email',
        'address',
        'registered_address',
        'registered_address_latitude',
        'registered_address_longitude',
        'plant_address',
        'plant_address_latitude',
        'plant_address_longitude',
        'billing_address',
        'billing_address_latitude',
        'billing_address_longitude',
        'gst',
        'notes',
        'group_id',
        'created_at',
        'updated_at',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_name', 'id');
    }

    public function getPersonNameAttribute($value)
    {
        try {
            return json_decode($value);
        } catch (\Exception $e) {
            return $value;
        }
    }
    public function getPhoneNumberAttribute($value)
    {
        try {
            return json_decode($value);
        } catch (\Exception $e) {
            return $value;
        }
    }
    public function getEmailAttribute($value)
    {
        try {
            return json_decode($value);
        } catch (\Exception $e) {
            return $value;
        }
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
    public function quotationDetails()
    {
        return $this->hasMany(QuotationDetails::class, 'quotation_id', 'id');
    }
}
