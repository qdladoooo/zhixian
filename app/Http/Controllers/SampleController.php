<?php

namespace App\Http\Controllers;

use App\Http\Models\ImportLog;
use App\Http\Models\Sample;
use App\Http\Models\Patient;
use App\Http\Requests;
use App\Libs\SampleImporter;
use App\Libs\Sphinx;
use App\Libs\Utils;
use Illuminate\Support\Facades\Input;
use App\Libs\SweeterFetch;

class SampleController extends Controller
{
    public function getIndex() {
        return view('sample.index');
    }

    public function postIndex() {
        $data = request()->all();
        $data['hospital'] = ($data['hospital'] == '其他') ? $data['other_hospital'] : $data['hospital'];
        $data['inflammation'] = ($data['inflammation'] == '其他') ? $data['other_inflammation'] : $data['inflammation'];
        $data['autoimmune'] = ($data['autoimmune'] == '其他') ? $data['other_autoimmune'] : $data['autoimmune'];
        $data['tumour_location'] = ($data['tumour_location'] == '其他') ? $data['other_tumour_location'] : $data['tumour_location'];

        Patient::create($data);
        Sample::create($data);

        return view('sample.index');
    }

    public function getPatient() {
        $page = (int)Input::get('p');
        $page = $page ?: 1;

        //每页20条
        $limit = 20;
        $offset = ($page-1)*$limit;

        //总条数
        $sphinx = new Sphinx();
        $sql = 'select count(*) from sample';
        $count = $sphinx->Es($sql);
        $max = ceil($count/$limit);

        $db = new SweeterFetch();
        $sql = "select *, p.id as patient_id, p.updated_at as input_time from patient p inner join sample d on p.id = d.patient_id order by d.id desc limit {$offset}, {$limit}";
        $rows = $db->Eq( $sql );

        //分页控件
        $paginator = Utils::paginator('/sample/patient?', $page, $max );

        return view('sample.patient', ['rows'=>$rows, 'paginator'=>$paginator]);
    }

    public function getImport() {

        $logs = ImportLog::orderBy('id', 'desc')->take(10)->get();
        return view('sample.import', ['logs'=>$logs]);
    }
}
