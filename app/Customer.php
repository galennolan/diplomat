<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Customer extends Model
{
    
    
    protected $table = "customer";
    protected $fillable=['area','rayon','name','telp','id_user','kab','venue','jenis_kelamin','umur','pekerjaan','rokok','jml_beli','tempatbeli','alasan','akanbeli','hargadip','pernahrasa','rasadip','IG','email','kemasan','open'];

    
}
