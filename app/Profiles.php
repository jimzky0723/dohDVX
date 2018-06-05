<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profiles extends Model
{
    protected $table = 'profiles';
    protected $fillable = [
        'unique_id',
        'tsekap_id',
        'list_number',
        'facility_name',
        'lname',
        'fname',
        'mname',
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
        'remarks',
        'status'
    ];
}
