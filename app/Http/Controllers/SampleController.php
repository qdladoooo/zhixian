<?php

namespace App\Http\Controllers;

use App\Http\Models\ImportLog;
use App\Http\Models\Sample;
use App\Http\Models\Patient;

use App\Http\Requests;
use App\Libs\SampleImporter;
use Illuminate\Support\Facades\Input;
use App\Libs\SweeterFetch;


class SampleController extends Controller
{
    public function getIndex() {
        return view('sample.index');
    }

    public function postIndex() {
        //患者信息
        $name = Input::get('name');
        $age = Input::get('age');
        $gender = Input::get('gender');
        $hospital = Input::get('hospital');
        if( $hospital == '其他' ) {
            $hospital = Input::get('other_hospital');
        }
        $check_in_no = Input::get('check_in_no');
        $card_id = Input::get('card_id');
        $tel = Input::get('tel');

        $patient = new Patient();
        $patient->name = $name;
        $patient->age = $age;
        $patient->gender = $gender;
        $patient->hospital = $hospital;
        $patient->check_in_no = $check_in_no;
        $patient->card_id = $card_id;
        $patient->tel = $tel;
        $patient->save();

        //病理信息及检测值
        $store_position = Input::get('store_position');
        $is_healthy = Input::get('is_healthy');
        $inflammation = Input::get('inflammation');
        if( $inflammation == '其他' ) {
            $inflammation = Input::get('other_inflammation');
        }
        $autoimmune = Input::get('autoimmune');
        if( $autoimmune == '其他' ) {
            $autoimmune = Input::get('other_autoimmune');
        }
        $tumour_info = Input::get('tumour_info');
        $other_disease = Input::get('other_disease');
        $tumour_location = Input::get('tumour_location');
        if( $tumour_location == '其他' ) {
            $tumour_location = Input::get('other_tumour_location');
        }
        $tumour_gross = Input::get('tumour_gross');
        $tumour_typing = Input::get('tumour_typing');
        $tumour_grade = Input::get('tumour_grade');
        $tumour_stage = Input::get('tumour_stage');
        $tumour_size = Input::get('tumour_size');
        $tumour_transfer = Input::get('tumour_transfer');
        $tumour_long_transfer = Input::get('tumour_long_transfer');
        $tumour_marker = Input::get('tumour_marker');

        $AFP = Input::get('AFP');
        $AFP_desc = Input::get('AFP_desc');
        $CA125 = Input::get('CA125');
        $CA125_desc = Input::get('CA125_desc');
        $CEA = Input::get('CEA');
        $CEA_desc = Input::get('CEA_desc');
        $CA199 = Input::get('CA199');
        $CA199_desc = Input::get('CA199_desc');
        $CYFRA21_1 = Input::get('CYFRA21-1');
        $CYFRA21_1_desc = Input::get('CYFRA21-1_desc');
        $PSA = Input::get('PSA');
        $PSA_desc = Input::get('PSA_desc');
        $detected_value = Input::get('detected_value');

        $sample = new Sample();
        $sample->patient_id = $patient->id;
        $sample->store_position = $store_position;
        $sample->is_healthy = $is_healthy;
        $sample->inflammation = $inflammation;
        $sample->autoimmune = $autoimmune;
        $sample->tumour_info = $tumour_info;
        $sample->other_disease = $other_disease;
        $sample->tumour_location = $tumour_location;
        $sample->tumour_gross = $tumour_gross;
        $sample->tumour_typing = $tumour_typing;
        $sample->tumour_grade = $tumour_grade;
        $sample->tumour_stage = $tumour_stage;
        $sample->tumour_size = $tumour_size;
        $sample->tumour_transfer = $tumour_transfer;
        $sample->tumour_long_transfer = $tumour_long_transfer;
        $sample->tumour_marker = $tumour_marker;

        $sample->afp = $AFP;
        $sample->afp_desc = $AFP_desc;
        $sample->ca125 = $CA125;
        $sample->ca125_desc = $CA125_desc;
        $sample->cea = $CEA;
        $sample->cea_desc = $CEA_desc;
        $sample->ca199 = $CA199;
        $sample->ca199_desc = $CA199_desc;
        $sample->cyfra21_1 = $CYFRA21_1;
        $sample->cyfra21_1_desc = $CYFRA21_1_desc;
        $sample->psa = $PSA;
        $sample->psa_desc = $PSA_desc;
        $sample->detected_value = $detected_value;

        $sample->save();

        return view('sample.index');
    }

    public function getPatient() {

//        $db = new SweeterFetch();
//        $sql = 'select *, p.id as patient_id, p.updated_at as input_time from patient p inner join sample d on p.id = d.patient_id';
//        $rows = $db->Eq( $sql );

        $rows = [];

        return view('sample.patient', ['rows'=>$rows]);
    }

    public function getImport() {

        $logs = ImportLog::orderBy('id', 'desc')->take(10)->get();
        return view('sample.import', ['logs'=>$logs]);
    }
}
