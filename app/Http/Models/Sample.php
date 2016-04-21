<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Sample extends Model {

    protected $table = 'sample';
    protected $fillable = ['is_healthy', 'inflammation', 'autoimmune', 'tumour_info', 'tumour_location', 'tumour_gross', 'tumour_typing', 'tumour_grade', 'tumour_stage', 'tumour_size', 'tumour_transfer', 'tumour_long_transfer', 'afp', 'ca125', 'cea', 'ca199', 'cyfra21_1', 'psa', 'detected_value'];
}


