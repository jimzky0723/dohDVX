<?php

namespace App\Http\Controllers;

use App\Barangay;
use App\Dengvaxia;
use App\Muncity;
use App\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Excel;
use App\TsekapProfile;

class MaatwebsiteController extends Controller
{
    public function importExport()
    {
        return view('admin/importExport');
    }
    public function importExcel(Request $request)
    {
        $path = $request->file('import_file')->getRealPath();
        $excelData = Excel::load($path)->get();
        foreach($excelData as $key => $row){
            if($bar_que = Barangay::where('description','=',$row->barangay)->first()){
                $barangay_id = $bar_que->id;
            } else {
                $barangay_id = "NO ID";
            }
            if($mun_que = Muncity::where('description','=',$row->muncity)->first()){
                $municipality_id = $mun_que->id;
            } else {
                $municipality_id = "NO ID";
            }
            if($pro_que = Province::where('description','=',$row->province)->first()){
                $province_id = $pro_que->id;
            } else {
                $province_id = "NO ID";
            }
            if($row->date_of_birth_mmddyyyy){
                $dob = date('Y-m-d',strtotime($row->date_of_birth_mmddyyyy));
            } else {
                $dob = "NO DOB";
            }

            if($tsekap_profile = TsekapProfile::where('fname','=',$row->first_name)->where('lname','=',$row->last_name)->where('dob','=',$dob)->first(['id','dengvaxia'])){
                $tsekap_id = $tsekap_profile->id;
                $tsekap_profile->update([
                   'dengvaxia' => 'yes'
                ]);
            } else {
                $tsekap_id = "";
            }
            $excelInsert[] = [
                'identification_number' => $row->identification_number,
                'fac_province' => $row->fac_province,
                'fac_muncity' => $row->fac_muncity,
                'facility_name' => $row->facility_name,
                'lname' => $row->last_name,
                'fname' => $row->first_name,
                'mname' => $row->mi,
                'house_number' => $row->house_stsitiopurok,
                'barangay_id' => $barangay_id,
                'muncity_id' => $municipality_id,
                'province_id' => $province_id,
                'barangay' => $row->barangay,
                'muncity' => $row->muncity,
                'province' => $row->province,
                'dob' => $row->date_of_birth_mmddyyyy,
                'age' => $row->age,
                'sex' => $row->sex_male_female,
                'first_dose_screened' => $row->first_dose_screened_yesno,
                'first_dose_date_given' => $row->first_dose_date_given,
                'first_dose_age' => $row->first_dose_age,
                'validation' => $row->validationwithin_the_range_9_14yo,
                'one_def' => $row->one_def,
                'two_def' => $row->two_def,
                'three_def' => $row->three_def,
                'four_def' => $row->four_def,
                'five_def' => $row->five_def,
                'six_def' => $row->six_def,
                'seven_def' => $row->seven_def,
                'eight_def' => $row->eight_def,
                'nine_def' => $row->nine_def,
                'ten_def' => $row->ten_def,
                'eleven_def' => $row->eleven_def,
                'twelve_def' => $row->twelve_def,
                'first_dose_lotNum' => $row->first_dose_lot,
                'first_dose_batchNum' => $row->first_dose_batch_no,
                'first_dose_expiration' => $row->first_dose_expiration_mmddyy,
                'first_dose_aefi' => $row->first_dose_aefi_yesno,
                'remarks' => $row->remarks,
                'second_dose_screened' => $row->second_dose_screened_yesno,
                'second_dose_date_given' => $row->second_dose_date_given,
                'second_dose_age' => $row->second_dose_age,
                'second_dose_reasons_refused' => $row->second_dose_reasons_of_refused,
                'tsekap_id' => $tsekap_id
            ];
        }

        Dengvaxia::insert($excelInsert);

        Session::put('uploadCount',count($excelInsert));
        return redirect('admin/dengvaxia_list');
    }
}
