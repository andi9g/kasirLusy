<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Kasir extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualan', function (Blueprint $table) {
            $table->bigIncrements('idpenjualan');
            $table->String('namabarang');
            $table->double('harga');
            $table->integer('jumlah');
            $table->date('tanggal');
            $table->String('metodepembayaran');
            $table->timestamps();
        });

        Schema::create('keranjang', function (Blueprint $table) {
            $table->bigIncrements('idkeranjang');
            $table->String('namabarang');
            $table->String('harga');
            $table->String('jumlah');
            $table->String('tanggal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
