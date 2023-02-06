<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = 'unit';


    public function users()
    {
        return $this->belongsToMany(User::class, 'unit_users', 'unit_id', 'users_id');
    }

    public function pengadaan()
    {
        return $this->hasMany(Pengadaan::class);
    }
}
