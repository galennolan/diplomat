<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $primaryKey = 'Id_setting';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $table = "setting";
    protected $fillable=['Id_setting','no_akun','nama_transaksi'];
}
