<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\profiles;

class ApiCtrl extends Controller
{
    public function __construct()
    {

    }

    public function api(Request $request){
        switch ($request->cmd){
            case 'profiles' :
                    $offset = $request->offset;
                    $keyword = $request->keyword;
                    $record = Profiles::
                    leftjoin('barangay', 'profiles.barangay', '=', 'barangay.id')
                        ->leftjoin('muncity', 'profiles.muncity', '=', 'muncity.id')
                        ->select(DB::raw("CONCAT(profiles.fname,' ',profiles.lname) AS full_name"),DB::raw("CONCAT(barangay.description,', ',muncity.description) AS address"),'profiles.dob','profiles.remarks','profiles.status','profiles.id')
                        ->where(function($q) use ($keyword){
                            $q->where('fname','like',"$keyword%")
                                ->orWhere('lname','like',"$keyword%");
                        })
                        ->where('fname','<>','')
                        ->where('lname','<>','')
                        ->orderBy('fname','asc')
                        ->offset($offset)->limit(10)->get();

                    return $record;
                break;
            case 'dose' :
                return Profiles::where('tsekap_id','=',$request->id)->get(
                    [
                        'list_number',
                        'facility_name',
                        'dose_screened',
                        'dose_date_given',
                        'dose_lot_no',
                        'dose_batch_no',
                        'dose_expiration',
                        'dose_AEFI',
                        'remarks',
                        'status'
                    ]
                );
                break;
        }


    }


}
