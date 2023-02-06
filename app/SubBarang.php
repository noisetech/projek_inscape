<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubBarang extends Model
{
    protected $table = 'sub_barang';

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function spesifikasi_sub_barang()
    {
        return $this->hasMany(SpesifikasiSubBarang::class);
    }

    public function spesifikasi_sub_barang_pengadaan()
    {
        return $this->belongsToMany(SpesifikasiSubBarangPengadaan::class, 'spesifikasi_sub_barang_pengadaan', 'pengadaan_id', 'spesifikasi_parameter_id');
    }
}
