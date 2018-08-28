<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    protected $connection = 'tsekap_main';
    protected $table = 'barangay';
}
