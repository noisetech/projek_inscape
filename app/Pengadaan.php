<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengadaan extends Model
{
    protected $table = 'pengadaan';

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function tahun()
    {
        return $this->belongsTo(Tahun::class);
    }

    public function step()
    {
        return $this->hasMany(StepPengadaan::class);
    }

    public function direksi()
    {
        return $this->hasMany(DireksiPengadaan::class);
    }
}
