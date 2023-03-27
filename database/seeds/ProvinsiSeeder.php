<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('provinsi')->insert([
            ['nama_provinsi' => 'Jawa Barat'],
            ['nama_provinsi' => 'Jawa Tengah'],
            ['nama_provinsi' => 'Yogyakarta'],
            ['nama_provinsi' => 'Jawa Timur'],
        ]);
    }

}
