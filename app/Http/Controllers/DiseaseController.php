<?php

namespace App\Http\Controllers;

use App\Http\Models\Disease;
use App\Http\Models\Patient;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Models\User;
use Illuminate\Support\Facades\Input;
use App\Libs\SweeterFetch;

class DiseaseController extends Controller
{
    public function getIndex() {
        return view('disease.index');
    }

    public function postIndex() {

        $name = Input::get('name');
        $age = Input::get('age');
        $gender = Input::get('gender');
        $hospital = Input::get('hospital');
        $check_in_no = Input::get('check_in_no');
        $card_id = Input::get('card_id');
        $tel = Input::get('tel');
        $sample_create_time = Input::get('sample_create_time');
        $qr = Input::get('qr');
        $store_position = Input::get('store_position');

        $is_heathy = Input::get('is_heathy');
        $tumour_location = Input::get('tumour_location');
        $tumour_gross = Input::get('tumour_gross');
        $tumour_size = Input::get('tumour_size');
        $tumour_grade = Input::get('tumour_grade');
        $tumour_stage = Input::get('tumour_stage');
        $tumour_typing = Input::get('tumour_typing');
        $tumour_marker = Input::get('tumour_marker');

        $patient = new Patient();
        $patient->name = $name;
        $patient->age = $age;
        $patient->gender = $gender;
        $patient->hospital = $hospital;
        $patient->check_in_no = $check_in_no;
        $patient->card_id = $card_id;
        $patient->tel = $tel;
        $patient->sample_create_time = $sample_create_time;
        $patient->qr = $qr;
        $patient->store_position = $store_position;
        $patient->save();

        $disease = new Disease();
        $disease->patient_id = $patient->id;
        $disease->is_heathy = $is_heathy;
        $disease->tumour_location = $tumour_location;
        $disease->tumour_gross = $tumour_gross;
        $disease->tumour_size = $tumour_size;
        $disease->tumour_grade = $tumour_grade;
        $disease->tumour_stage = $tumour_stage;
        $disease->tumour_typing = $tumour_typing;
        $disease->tumour_marker = $tumour_marker;
        $disease->save();

        return view('disease.index');
    }

    public function getPatient() {

        $db = new SweeterFetch();
        $sql = 'select *, p.id as patient_id, p.updated_at as input_time from patient p inner join disease d on p.id = d.patient_id';
        $rows = $db->Eq( $sql );

        return view('disease.patient', ['rows'=>$rows]);
    }

}
