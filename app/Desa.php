<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    use HasFactory;
    protected $table = 'tbl_desa';
    protected $fillable = [
        'desa_nama',
        'desa_kec'
    ];
    protected $primaryKey = 'desa_kode';
    public $incrementing = false;
    protected $keyType = 'string';
}