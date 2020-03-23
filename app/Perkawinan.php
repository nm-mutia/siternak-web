<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perkawinan extends Model
{
    public function ternak(){
        return $this->belongsTo('App\Ternak');
    }
}
