<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;
    protected $table = 'tbl_kecamatan';
    protected $fillable = [
        'kec_nama',
        'kec_kab'
    ];
    protected $primaryKey = 'kec_kode';
    public $incrementing = false;
    protected $keyType = 'string';
}
