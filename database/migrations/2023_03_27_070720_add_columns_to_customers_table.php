<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('customer', function (Blueprint $table) {
        $table->string('venue')->nullable();
        $table->string('telp')->nullable();
        $table->enum('jenis_kelamin', ['laki-laki', 'perempuan'])->nullable();
        $table->integer('umur')->nullable();
        $table->string('pekerjaan')->nullable();
        $table->string('merk_rokok')->nullable();
        $table->integer('jml_beli')->nullable();
        $table->boolean('diplomatmild')->default(false);
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            //
        });
    }
}
