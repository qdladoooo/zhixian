<?php namespace App\Libs;
use App\Http\Models\ImportLog;
use App\Http\Models\Patient;
use App\Http\Models\Sample;
use Illuminate\Support\Facades\Redis;
use SimpleExcel\SimpleExcel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * 导入用户上传的csv文件到数据库
 *
 *
*/

class SampleImporter {
    const REDIS_SETS_KEY_UPLOADED_FILE = 'UPLOADED_FILE';

    public static function import() {
        $si = new SampleImporter();
        //取得文件地址
        $files = $si->getUploadFilePath();
        foreach($files as $file) {
            //获取文件内容
            $data = $si->analyseCSV($file);
            //导入数据库
            $success = $si->saver($data);
            if($success) {
                Redis::sadd(self::REDIS_SETS_KEY_UPLOADED_FILE, $file);
                ImportLog::create(['file_name'=>$file, 'success'=>$success]);
            } else {
                ImportLog::create(['file_name'=>$file, 'success'=>$success]);
            }
        }
    }

    //获取上传的还未导入的csv文件名
    public function getUploadFilePath() {
        //上传文件夹地址
        //todo: 命令行不适用
//        $path = dirname( $_SERVER['DOCUMENT_ROOT'] ) . './storage/upload_file/';
        $path = '/var/www/zhixian.wobu2.com/storage/upload_file/';
        $files = scandir($path);

        //存放没被导入过的文件
        $to_import_files = [];
        foreach($files as $file) {
            //绝对路径
            $ab_path = $path . $file;
            if( preg_match('/\.csv$/i', $ab_path) && !Redis::sismember(self::REDIS_SETS_KEY_UPLOADED_FILE, $ab_path) ) {
                array_push($to_import_files, $ab_path);
            }
        }

        return $to_import_files;
    }

    //将文件中的数据解释为数组
    public function analyseCSV( $file ) {
        $excel = new SimpleExcel('CSV');
        $excel->parser->loadFile( $file );

        $field = $excel->parser->getField();
        $keys = ['name', 'age', 'gender', 'check_in_no', 'card_id', 'tel', 'is_healthy', 'inflammation', 'autoimmune', 'tumour_info', 'tumour_location', 'tumour_gross', 'tumour_typing', 'tumour_grade', 'tumour_stage', 'tumour_size', 'tumour_transfer', 'tumour_long_transfer', 'afp', 'ca125', 'cea', 'ca199', 'cyfra21_1', 'psa', 'detected_value'];

        $data = [];
        foreach($field as $rows) {
            $row = $rows[0];
            $row = mb_convert_encoding($row, 'utf8', 'cp936');

            $cols = explode(';', $row);


            $data[] = array_combine($keys, $cols);
        }
        array_shift($data);

        return $data;
    }

    //将数据保存至数据库
    public function saver( $data ) {
        $flag = true;
        DB::beginTransaction();

        //todo: 患者去重
        foreach($data as $row) {

            $r1 = $patient = Patient::create($row);
            $r2 = $sample = Sample::create($row);
            $sample->patient_id = $patient->id;
            $r3 = $sample->save();
            if(!($r1 && $r2 && $r3)) {
                $flag = false;
            }
        }

        if($flag) {
            DB::commit();
        } else {
            DB::rollBack();
        }

        return $flag;
    }
}