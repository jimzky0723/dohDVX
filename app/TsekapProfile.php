<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TsekapProfile extends Model
{
    protected $connection = 'tsekap_main';
    protected $table = 'profile';
    protected $primaryKey = 'id';
    protected $fillable = ['dengvaxia'];
}
