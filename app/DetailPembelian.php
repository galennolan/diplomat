<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPembelian extends Model
{
     //jika tidak di definisikan makan primary akan terdetek id
     protected $primaryKey = 'no_beli';
     public $incrementing = false;
     protected $keyType = 'string';
     public $timestamps = false;
     protected $table = "detail_pembelian";
     protected $fillable=['no_beli','kd_brg','qty_beli','sub_beli'];
 
}
