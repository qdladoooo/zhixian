<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model {

    protected $table = 'patient';
    protected $fillable = ['name', 'age', 'gender', 'check_in_no', 'card_id', 'tel'];
}


