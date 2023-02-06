<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';


    public function sub_barang()
    {
        return $this->hasMany(SubBarang::class);
    }

    public function parameter_barang()
    {
        return $this->hasMany(ParameterBarang::class);
    }
}
