<?php

namespace App\Http\Controllers;

use App\Muncity;
use App\Province;
use Illuminate\Http\Request;

class ParamCtrl extends Controller
{
    static function getAge($date){
        //date in mm/dd/yyyy format; or it can be in other formats as well
        $birthDate = date('m/d/Y',strtotime($date));
        //explode the date to get month, day and year
        $birthDate = explode("/", $birthDate);
        //get age from date or birthdate
        $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
            ? ((date("Y") - $birthDate[2]) - 1)
            : (date("Y") - $birthDate[2]));
        return $age;
    }

    static function ageDiff($dob,$date)
    {
        $birthDate = date('m/d/Y',strtotime($date));
    }

    static function getMuncityName($id)
    {
        $muncity = Muncity::find($id);
        if($muncity){
            return $muncity->description;
        }
        return 'N/A';
    }

    static function getProvinceName($id)
    {
        $province = Province::find($id);
        if($province){
            return $province->description;
        }
        return 'N/A';
    }

    public function getMuncity($province_id)
    {
        $muncity = Muncity::where('province_id',$province_id)
            ->get();
        return $muncity;
    }
}
