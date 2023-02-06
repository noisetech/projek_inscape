<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpesifikasiSubBarangPengadaan extends Model
{
    protected $table = 'spesifikasi_sub_barang_pengadaan';

    public function pengadaan()
    {
        return $this->belongsToMany(Pengadaan::class, 'spesifikasi_sub_barang_pengadaan', 'pengadaan_id', 'spesifikasi_parameter_id');
    }

    public function spesifikasi_parameter()
    {
        return $this->belongsToMany(SpesifikasiParameter::class, 'spesifikasi_sub_barang_pengadaan', 'pengadaan_id', 'spesifikasi_parameter_id');
    }
}
