<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $primaryKey = 'kd_cust';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $table = "barang";
       protected $fillable=['kd_cust','nm_brg','harga','stok'];
}
