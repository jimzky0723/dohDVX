<?php

namespace App\Http\Controllers;

use App\Dengvaxia;
use App\Muncity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class DengvaxiaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('admin');
    }

    public function dengvaxia(Request $request,$muncityId = null)
    {
        $duplicate = $request->get('duplicate');
        $keyword = $request->keyword;

        $dengvaxia = new Dengvaxia();
        if($muncityId == 'all' && $duplicate != 'duplicate'){
            $municipality = 'all';
            $records = $dengvaxia->
            where(function($q) use ($keyword){
                $q->where('fname','like',"%$keyword%")
                    ->orWhere('lname','like',"%$keyword%");
            })
                ->where('status','=','1')
                ->orderBy('lname','asc')
                ->paginate(30);
        }
        elseif($duplicate == 'duplicate'){
            $municipality = Muncity::find($muncityId);

            $records = \DB::connection('mysql')->select("SELECT
                        /*y.id,y.fname,y.mname,y.lname,y.barangay_id,y.muncity_id,y.province_id,
                        y.identification_number,y.sex,y.dob,y.age,y.first_dose_screened,
                        y.first_dose_date_given,y.first_dose_age,y.first_dose_lotNum,
                        y.first_dose_expiration*/
                        *
                        FROM dengvaxia_profiles y
                            INNER JOIN (SELECT
                                            lname,fname,count(*) as countoff
                                            FROM dengvaxia_profiles
                                            GROUP BY lname,fname
                                            HAVING countoff>1
                                        ) dt ON y.lname=dt.lname AND y.fname=dt.fname where y.status = 1 order by y.lname asc");

        }
        else {
            $municipality = Muncity::find($muncityId);
            $records = $dengvaxia->
            where(function($q) use ($keyword){
                $q->where('fname','like',"%$keyword%")
                    ->orWhere('lname','like',"%$keyword%");
            })
                ->where('status','=','1')
                ->where('muncity_id','=',$muncityId)
                ->orderBy('lname','asc')
                ->paginate(30);
        }

        return view('admin.dengvaxia',[
            'title' => 'List of Dengvaxia',
            'records' => $records,
            'keyword' => $keyword,
            'mun_row' => $municipality,
            'muncityId' => $muncityId,
            'duplicate' => $duplicate
        ]);
    }

    public function delete_dengvaxia(Request $request){
        $dengvaxia = Dengvaxia::find($request->delete_dengvaxia);
        $name = $dengvaxia->lname.', '.$dengvaxia->fname.' '.$dengvaxia->mname;
        $dengvaxia->update([
           'status' => 0
        ]);

        Session::flash('deng_del', $name." successfully deleted!");
        return Redirect::back();
    }


}
