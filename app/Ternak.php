<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ternak extends Model
{
    protected $keyType = 'string';

    public function penyakit(){
        return $this->belongsToMany('App\Penyakit');
    }

    public function perkawinan(){
        return $this->hasMany('App\Perkawinan');
    }

    public function ras(){
        return $this->belongsTo('App\Ras');
    }

    public function pemilik(){
        return $this->belongsTo('App\Pemilik');
    }

    public function kematian(){
        return $this->belongsTo('App\Kematian');
    }
}
