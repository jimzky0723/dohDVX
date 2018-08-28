<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $connection = 'tsekap_main';
    protected $table = 'province';
}
