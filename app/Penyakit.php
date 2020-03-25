<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penyakit extends Model
{
	protected $fillable = [
    	'nama_penyakit', 'ket_penyakit',
    ];

    public function ternak(){
        return $this->belongsToMany('App\Ternak', 'riwayat_penyakits', 'pemilik_id', 'necktag');
    }
}
