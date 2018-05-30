<?php

namespace App\Http\Controllers\admin;

use App\Muncity;
use App\Profiles;
use App\Pending;
use App\Province;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ProfileCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index($requestName,Request $request)
    {
        $keyword = $request->keyword;
        $requestName == 'profiles' ? $profile = new Profiles() : $profile = new Pending();
        $records = $profile->
            where(function($q) use ($keyword){
                $q->where('fname','like',"%$keyword%")
                    ->orWhere('mname','like',"%$keyword%")
                    ->orWhere('lname','like',"%$keyword%");
            })
            ->orderBy('lname','asc')
            ->paginate(30);
        return view('admin.profiles',[
            'title' => 'List of Profiles',
            'records' => $records,
            'keyword' => $keyword,
            'requestName' => $requestName
        ]);
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

    public function edit($id,$requestName,Request $request)
    {
        $message = '';
        $requestName == 'profiles' ? $record = new Profiles() : $record = new Pending();
        $data = $record->find($id);
        if ($request->isMethod('post')) {
            $editData[] = $request->all();
            unset($editData[0]['_token']);
            $data->update($editData[0]);
            $message = 'updated';
        }
        return view('admin.addProfile',[
            'profileId' => $id,
            'title' => 'Update '.ucfirst($requestName),
            'method' => 'update',
            'data' => $data,
            'requestName' => $requestName
        ])->with('message',$message);

    }

    public function create($requestName,Request $req)
    {
        $message = '';
        if ($req->isMethod('post')) {
            $message = 'saved';
            $unique_id = $req->fname.$req->mname.$req->lname.date('Ymd',strtotime($req->dob)).$req->barangay;
            $data = array(
                'fac_province' => $req->fac_province,
                'fac_muncity' => $req->fac_muncity,
                'facility_name' => $req->facility_name,
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
                'remarks' => "$req->remarks",
                'status' => $requestName
            );
            $match = array('unique_id' => $unique_id);
            $requestName == 'profiles' ? $record = new Profiles() : $record = new Pending();
            $record->updateOrCreate($match,$data);
        }
        return view('admin.addProfile',[
            'title' => 'Add '.ucfirst($requestName),
            'method' => 'create',
            'requestName' => $requestName
        ])->with('message',$message);
    }

    public function store($requestName,Request $req)
    {
        $unique_id = $req->fname.$req->mname.$req->lname.date('Ymd',strtotime($req->dob)).$req->barangay;
        $data = array(
            'fac_province' => $req->fac_province,
            'fac_muncity' => $req->fac_muncity,
            'facility_name' => $req->facility_name,
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
            'remarks' => "$req->remarks",
            'status' => $requestName
        );
        $match = array('unique_id' => $unique_id);
        $requestName == 'profiles' ? $record = new Profiles() : $record = new Pending();
        $record->updateOrCreate($match,$data);

        return redirect()->back()->with('message','saved');
    }

    public function verify(Request $request){
        $request->request->add(Pending::find($request->profileId)->attributesToArray());
        $this->create('profiles',$request);
        Pending::find($request->profileId)->delete();
        Session::put('verified',true);
        return redirect()->to('admin/profiles'.'/'.$request->requestName);
    }

    public function remove(Request $request){
        $request->requestName == 'profiles' ? $record = new Profiles() : $record = new Profiles();
        $record->find($request->profileId)->delete();
        Session::put('remove',true);
        return redirect()->to('admin/profiles'.'/'.$request->requestName);
    }

    public function refuse(Request $request){
        $request->requestName == 'profiles' ? $record = new Profiles() : $record = new Profiles();
        $record->find($request->profileId)->update([
            'remarks' => $request->remarks,
            'status' => 'refuse'
        ]);

        Session::put('refuse',true);
        return redirect()->to('admin/profiles'.'/'.$request->requestName);
    }

}
