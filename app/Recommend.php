<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recommend extends Model
{
    //
    public function application() 
    {
        return $this->belongsTo('App\Application');
    }     
}
