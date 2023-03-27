<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KabupatenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kabupaten = [
            ['nama_kabupaten' => 'Sukoharjo', 'id_provinsi' => 2],
            ['nama_kabupaten' => 'Solo', 'id_provinsi' => 2],
            ['nama_kabupaten' => 'Karanganyar', 'id_provinsi' => 2],
                 ['nama_kabupaten' => 'Boyolali', 'id_provinsi' => 2],
                        ['nama_kabupaten' => 'Klaten', 'id_provinsi' => 2],
            ['nama_kabupaten' => 'Wonogiri', 'id_provinsi' => 2],
            // dan seterusnya...
        ];

        DB::table('kabupaten')->insert($kabupaten);
    }
}
