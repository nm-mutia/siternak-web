<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ternak extends Model
{
    protected $keyType = 'string';
    // protected $incrementing = false;
    protected $primaryKey = 'necktag';

    protected $fillable = [
        'necktag', 'pemilik_id', 'ras_id', 'kematian_id', 'jenis_kelamin', 'tgl_lahir',
        'bobot_lahir', 'pukul_lahir', 'lama_dikandungan', 'lama_laktasi', 'tgl_lepas_sapih', 'blood',
        'necktag_ayah', 'necktag_ibu', 'bobot_tubuh', 'panjang_tubuh', 'tinggi_tubuh', 'cacat_fisik', 'ciri_lain', 'status_ada'
    ];

    public function penyakit(){
        return $this->belongsToMany('App\Penyakit', 'riwayat_penyakits', 'necktag', 'penyakit_id')
                    ->withPivot('tgl_sakit', 'obat', 'lama_sakit', 'keterangan')
                    ->withTimestamps();
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
