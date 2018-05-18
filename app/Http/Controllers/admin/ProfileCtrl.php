<?php

namespace App\Http\Controllers\admin;

use App\Muncity;
use App\Profiles;
use App\Province;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $records = Profiles::orderBy('lname','asc')
                ->paginate(30);
        return view('admin.profiles',[
            'title' => 'List of Profiles',
            'records' => $records
        ]);
    }

    public function search(Request $req)
    {

    }

    public function upload()
    {
        return view('admin.upload',[
            'title' => 'Upload Dengvaxia Data'
        ]);
    }

    public function getMuncityID($string,$id)
    {
        $muncity = Muncity::where('description','like',"%$string%")
                ->where('province_id',$id)
                ->first();
        if($muncity){
            return $muncity->id;
        }else{
            return 0;
        }
    }

    public function getProvinceID($string)
    {
        $province = Province::where('description','like',"%$string%")
            ->first();
        if($province){
            return $province->id;
        }else{
            return 0;
        }
    }



    function uploadData(Request $req)
    {
        $content = $req->data;
        $dateNow = date('Y-m-d H:i:s');

        foreach($content as $row){
            $content = str_getcsv($row, ",", '"');
            if(isset($content[4])){
                    $fac_province = self::getProvinceID($content[1]);
                    $fac_muncity = self::getMuncityID($content[2],$fac_province);

                    $province = self::getProvinceID($content[10]);
                    $muncity = self::getMuncityID($content[9],$province);

                    $fname = self::cleanString(utf8_decode($content[5]));
                    $mname = self::cleanString(utf8_decode($content[6]));
                    $lname = self::cleanString(utf8_decode($content[4]));
                    $barangay = self::cleanString(utf8_decode($content[8]));


                    $tmp = array(
                        $fname,
                        $mname,
                        $mname,
                        date('Ymd',strtotime($content[11])),
                        $barangay
                    );
                    $unique_id = implode("",$tmp);
                    $data = array(
                        'list_number' => $content[2].'-'.$content[0],
                        'fac_province' => $fac_province,
                        'fac_muncity' => $fac_muncity,
                        'facility_name' => isset($content[3]) ? $content[3] : '',
                        'lname' => $lname,
                        'fname' => $fname,
                        'mname' => $mname,
                        'sitio' => isset($content[7]) ? $content[7] : '',
                        'barangay' => $barangay,
                        'muncity' => $muncity,
                        'province' => $province,
                        'dob' => isset($content[11]) ? date('Y-m-d',strtotime($content[11])) : '',
                        'sex' => isset($content[13]) ? $content[13] : '',
                        'dose_screened' => isset($content[14]) ? $content[14] : '',
                        'dose_date_given' => isset($content[15]) ? date('Y-m-d',strtotime($content[15])) : '',
                        'dose_age' => isset($content[16]) ? $content[16] : '',
                        'validation' => isset($content[17]) ? $content[17] : '',
                        'dose_lot_no' => isset($content[18]) ? $content[18] : '',
                        'dose_batch_no' => isset($content[19]) ? $content[19] : '',
                        'dose_expiration' => isset($content[20]) ? date('Y-m-d',strtotime($content[20])) : '',
                        'dose_AEFI' => isset($content[21]) ? $content[21] : '',
                        'remarks' => isset($content[22]) ? $content[22] : '',
                    );
                    $match = array('unique_id' => $unique_id);
                    Profiles::updateOrCreate($match,$data);
            }

        }
        return array(
            'status' => 'success'
        );
    }

    function cleanString($text) {
        return str_replace('?','ñ',$text);
    }

    public function create()
    {
        return view('admin.addProfile',[
            'title' => 'Add Profile',
            'method' => 'create'
        ]);
    }

    public function edit($id)
    {
        $data = Profiles::find($id);
        return view('admin.addProfile',[
            'title' => 'Update Profile',
            'method' => 'update',
            'data' => $data
        ]);
    }

    public function store(Request $req)
    {
        $tmp = array(
            $req->fname,
            $req->mname,
            $req->mname,
            date('Ymd',strtotime($req->dob)),
            $req->barangay
        );
        $unique_id = implode("",$tmp);
        $data = array(
            'fac_province' => $req->fac_province,
            'fac_muncity' => $req->fac_muncity,
            'facility' => $req->facility,
            'fname' => $req->fname,
            'mname' => $req->mname,
            'lname' => $req->lname,
            'sitio' => $req->sitio,
            'barangay' => $req->barangay,
            'province' => $req->province,
            'muncity' => $req->muncity,
            'dob' => $req->dob,
            'sex' => $req->sex,
            'dose_screened' => $req->dose_screened,
            'dose_date_given' => $req->dose_date_given,
            'dose_age' => $req->dose_age,
            'validation' => $req->validation,
            'dose_lot_no' => $req->dose_lot_no,
            'dose_batch_no' => $req->dose_batch_no,
            'dose_expiration' => $req->dose_expiration,
            'dose_AEFI' => $req->dose_AEFI,
            'remarks' => "$req->remarks"
        );
        $match = array('unique_id' => $unique_id);
        Profiles::updateOrCreate($match,$data);

        return redirect()->back()->with('status','saved');

    }
}
