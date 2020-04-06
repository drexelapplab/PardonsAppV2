<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    //
    protected $table = "volunteers";

    public function application() 
    {
        return $this->belongsTo('App\Application');
    }     
}
