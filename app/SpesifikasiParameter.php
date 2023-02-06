<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpesifikasiParameter extends Model
{
    protected $table = 'spesifikasi_parameter';

    public function parameter_barang()
    {
        return $this->belongsTo(ParameterBarang::class);
    }

    public function spesifikasi_sub_barang()
    {
        return $this->hasMany(SpesifikasiSubBarang::class);
    }
}
