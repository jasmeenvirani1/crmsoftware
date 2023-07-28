<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Quotation extends Model
{
    use HasFactory;
    use Notifiable;
    public $table = "quotation";
    public $timestamps= true;
    protected $fillable = [
        'companyname',
        'personname',
        'phonenumber',
        'email',
        'address',
        'gst',
        'notes',
        'created_at',
        'updated_at',
    ];

    public function customer(){
        return $this->belongsTo(Customer::class,'customer_name','id');
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


}
