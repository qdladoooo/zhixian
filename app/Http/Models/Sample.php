<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Sample extends Model {

    protected $table = 'sample';
    protected $fillable = ['is_healthy', 'inflammation', 'autoimmune', 'tumour_info',
        'tumour_location', 'tumour_gross', 'tumour_typing', 'tumour_grade',
        'tumour_stage', 'tumour_size', 'tumour_transfer', 'tumour_long_transfer',
        'afp', 'afp_desc', 'ca125', 'ca125_desc', 'cea', 'cea_desc', 'ca199', 'ca199_desc',
        'cyfra21_1', 'cyfra21_1_desc', 'psa', 'psa_desc', 'detected_value', 'detected_value_desc',
        'flow_id', 'sampling_date', 'sample_no', 'other_disease', 'surgery_date',
        'tumour_stage_sample', 'tumour_primary', 'remark'
    ];
}


