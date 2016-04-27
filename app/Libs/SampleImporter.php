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
*/

class SampleImporter {
    const REDIS_SETS_KEY_UPLOADED_FILE = 'UPLOADED_FILE';

    /*
     * 导入
     *
     * 执行此命令,讲读取上传文件目录,将未导入过的文件导入至数据库.
     *
     * */
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

    /*
     * 将文件中的数据解释为数组
     *
     * 解析csv面对的几个问题
     * 1.字符编码 cp936 to utf-8
     * 2.换行符   \n vs \r\n
     * 3.字段分隔  作为分隔符的,(半角逗号) vs 文本中出现的,
     *
     * 这里不试图为以上问题寻找通用解法, 从输入文件控制变化
     *
     * */
    public function analyseCSV( $file ) {
        //表头与数据库字段的映射关系
        $key_map = ['姓名'=>'name', '年龄'=>'age', '性别'=>'gender', '住院号'=>'check_in_no', '来样医院'=>'hospital',
            '身份证号'=>'card_id', '电话号码'=>'tel',
            '流水号'=>'flow_id', '采样日期'=>'sampling_date', '来样样本号'=>'sample_no', '是否健康'=>'is_healthy',
            '炎症'=>'inflammation', '自身免疫性疾病'=>'autoimmune',  '其他疾病'=>'other_disease', '肿瘤'=>'tumour_info',
            '手术日期'=>'surgery_date', '肿瘤部位'=>'tumour_location', '大体分型'=>'tumour_gross',
            '组织分型'=>'tumour_typing', '组织分级'=>'tumour_grade', '临床分期'=>'tumour_stage',  '临床分期来样'=>'tumour_stage_sample',
            '肿瘤大小'=>'tumour_size', '原发肿瘤'=>'tumour_primary', '淋巴结转移情况'=>'tumour_transfer',
            '有无远处转移'=>'tumour_long_transfer',
            'AFP（酶免)'=>'afp',  'AFP结果判定'=>'afp_desc', 'CA125（酶免）值'=>'ca125',  'CA125结果判定'=>'ca125_desc',
            'CEA（酶免）值'=>'cea',  'CEA结果判定'=>'cea_desc',
            'CA199E值'=>'ca199',  'CA199E结果判定'=>'ca199_desc', 'CYFRA21-1(酶免)值'=>'cyfra21_1',  'CYFRA21-1结果判定'=>'cyfra21_1_desc',
            'PSAE值'=>'psa',  'PSAE结果判定'=>'psa_desc', '检测值'=>'detected_value',  '检测值结果判定'=>'detected_value_desc', '备注'=>'remark'];

        //读取csv文件, 按行分割
        $file_str = file_get_contents($file);
        $file_str = mb_convert_encoding($file_str, 'utf8', 'cp936');
        $lines = explode("\r\n", $file_str);

        //获取并处理表头
        $table_head_str = array_shift($lines);
        $table_head_ar = explode(',', $table_head_str);

        /*
         * 表格的列名可以任意调换顺序
         *
         * 遍历表头, 将汉字替换为对应的英文列名, 同时记录需要入库的表头序号, 在表格body中提取
         *
         * */
        $collect_index = [];
        $table_head_transer = [];
        foreach($table_head_ar as $i => $grid) {
            if( array_key_exists($grid, $key_map) ) {
                //获取表头数组
                array_push($table_head_transer, $key_map[$grid]);
                //收集对应的序号
                array_push($collect_index, $i);
            }
        }

        $data = [];
        foreach($lines as $row) {
            if( empty( trim($row) ) ) {
                continue;
            }
            $row_ar = explode(',', $row);
            $collect_ar = [];
            //遍历数据数组,取出需要收集的数据
            foreach($row_ar as $i=>$grid) {
                if( in_array($i, $collect_index) ) {
                    array_push($collect_ar, $grid);
                }
            }

            $data[] = array_combine($table_head_transer, $collect_ar);
        }

        return $data;
    }

    //将数据保存至数据库
    public function saver( $data ) {
        $flag = true;

        DB::beginTransaction();

        foreach($data as $row) {
            //患者去重
            //age, gender, 'afp', 'ca125', 'cea', 'ca199', 'cyfra21_1', 'psa'
            $patient = Patient::where(['age'=>$row['age'], 'gender'=>$row['gender']])->first();
            if( !empty($patient) ) {
                $sample = Sample::where(['patient_id'=>$patient->id, 'afp'=>$row['afp'], 'ca125'=>$row['ca125'], 'cea'=>$row['cea'], 'ca199'=>$row['ca199'], 'cyfra21_1'=>$row['cyfra21_1'], 'psa'=>$row['psa']])->first();
                if(!empty($sample)) {
                    continue;
                }
            }

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