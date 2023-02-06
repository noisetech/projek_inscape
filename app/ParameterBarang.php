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

    public function spesifikasi_sub_barang_pengadaan()
    {
        return $this->belongsToMany(SpesifikasiSubBarangPengadaan::class, 'spesifikasi_sub_barang_pengadaan', 'pengadaan_id', 'spesifikasi_parameter_id');
    }
}
