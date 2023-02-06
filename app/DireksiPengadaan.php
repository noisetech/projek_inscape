<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DireksiPengadaan extends Model
{
    protected $table = 'direksi_pengadaan';

    protected $fillable = [
        'pengadaan_id', 'nama', 'dokumen', 'status'
    ];

    public function pengadaan()
    {
        return $this->belongsTo(Pengadaan::class);
    }
}
