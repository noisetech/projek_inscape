<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParameterBarang extends Model
{
    protected $table = 'parameter_barang';

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function spesifikasi_parameter()
    {
        return $this->hasMany(SpesifikasiParameter::class);
    }


}
