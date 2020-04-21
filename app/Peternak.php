<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peternak extends Model
{
    protected $fillable = [
    	'peternakan_id', 'nama_peternak', 'username', 'password'
    ];

    public function peternakan(){
        return $this->belongsTo(Peternakan::class);
    }
}
