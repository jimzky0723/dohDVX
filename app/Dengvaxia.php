<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dengvaxia extends Model
{
    protected $table = 'dengvaxia_profiles';
    protected $fillable = [
        'identification_number',
        'fac_province',
        'fac_muncity',
        'facility_name',
        'lname',
        'fname',
        'mname',
        'house_number',
        'barangay_id',
        'muncity_id',
        'province_id',
        'barangay',
        'muncity',
        'province',
        'dob',
        'age',
        'sex',
        'first_dose_screened',
        'first_dose_date_given',
        'first_dose_age',
        'validation',
        'one_def',
        'two_def',
        'three_def',
        'four_def',
        'five_def',
        'six_def',
        'seven_def',
        'eight_def',
        'nine_def',
        'ten_def',
        'eleven_def',
        'twelve_def',
        'first_dose_lotNum',
        'first_dose_batchNum',
        'first_dose_expiration',
        'first_dose_aefi',
        'remarks',
        'second_dose_screened',
        'second_dose_date_given',
        'second_dose_age',
        'second_dose_reasons_refused',
        'tsekap_id',
        'status',
        'created_at',
        'updated_at'
    ];
}
