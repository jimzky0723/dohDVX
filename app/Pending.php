<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pending extends Model
{
    protected $table = 'pending';
    protected $fillable = [
        'unique_id',
        'list_number',
        'fac_province',
        'fac_muncity',
        'facility_name',
        'lname',
        'fname',
        'mname',
        'sitio',
        'barangay',
        'muncity',
        'province',
        'dob',
        'age',
        'sex',
        'dose_screened',
        'dose_date_given',
        'dose_age',
        'validation',
        'dose_lot_no',
        'dose_batch_no',
        'dose_expiration',
        'dose_AEFI',
        'remarks'
    ];
}
