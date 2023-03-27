<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerTable extends Migration
{
    public function up()
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->string('no_hp');
            $table->unsignedBigInteger('id_kabupaten');
            $table->unsignedBigInteger('id_provinsi');
            $table->timestamps();

            $table->foreign('id_kabupaten')->references('id')->on('kabupaten');
            $table->foreign('id_provinsi')->references('id')->on('provinsi');
        });
    }

    public function down()
    {
        Schema::dropIfExists('customer');
    }
}
