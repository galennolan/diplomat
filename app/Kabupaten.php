<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Kabupaten extends Model
{
    protected $table = "kabupaten";

    public function course()
{
    return $this->hasMany('App\Provinsi','id_provinsi','id');
}
}
