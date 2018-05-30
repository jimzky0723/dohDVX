<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Pending;
use App\Profiles;

class ApiCtrl extends Controller
{
    public function __construct()
    {

    }

    public function pendingApi(Request $request){
        $offset = $request->offset;
        $keyword = $request->keyword;

        $record = Pending::
            leftjoin('barangay', 'pending.barangay', '=', 'barangay.id')
            ->leftjoin('muncity', 'pending.muncity', '=', 'muncity.id')
            ->select(DB::raw("CONCAT(pending.fname,' ',pending.lname) AS full_name"),DB::raw("CONCAT(barangay.description,', ',muncity.description) AS address"),'pending.dob','pending.remarks','pending.status','pending.id')
            ->where(function($q) use ($keyword){
                $q->where('fname','like',"$keyword%")
                    ->orWhere('lname','like',"$keyword%");
            })
            ->where('fname','<>','')
            ->where('lname','<>','')
                ->orderBy('fname','asc')
                ->offset($offset)->limit(10)->get();

        return $record;
    }

}
