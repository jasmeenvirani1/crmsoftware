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
}
