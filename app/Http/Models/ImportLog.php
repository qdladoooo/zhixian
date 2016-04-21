<?php namespace App\Http\Models;

use Session;
use DB;
use Log;
use Illuminate\Database\Eloquent\Model;
use App\Libs\SweeterFetch;

class ImportLog extends Model {

    protected $table = 'import_log';
    protected $fillable = ['file_name', 'success'];
}


