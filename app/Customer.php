<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Customer extends Model
{
    
    
    protected $table = "customer";
   
    public function provinsi()
    {
        return $this->hasOne('App\Provinsi', 'id','nama_provinsi');
    }

    public function kabupaten()
    {
        return $this->hasOne('App\Kabupaten', 'id','nama_kabupaten');
    }
}
