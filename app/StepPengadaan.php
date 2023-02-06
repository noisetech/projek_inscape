<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StepPengadaan extends Model
{
    protected $table = 'step_pengdaan';

    public function pengadaan(){
        return $this->belongsTo(Pengadaan::class);
    }
}
