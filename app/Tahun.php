<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tahun extends Model
{
    protected $table = 'tahun';

    public function pengadaan()
    {
        return $this->hasMany(Pengadaan::class);
    }
}
