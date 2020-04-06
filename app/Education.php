<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Education extends Model
{
    //
    protected $table = 'educations';

    //private function getEducationDateValue() {
    //	return Carbon::createFromFormat('m/d/Y',$this->attributes['education_date']);
    //}

    public function application() 
    {

        return $this->belongsTo('App\Application');
    }
}
