<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Religion extends Model
{
    //
    protected $table = 'religions';
    
    public function application() 
    {
        return $this->belongsTo('App\Application');
    }     
}
