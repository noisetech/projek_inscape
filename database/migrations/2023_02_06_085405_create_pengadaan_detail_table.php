<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengadaanDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengadaan_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pengadaan_id');
            $table->unsignedBigInteger('sub_barang_id');
            $table->integer('score');
            $table->string('like_hood');
            $table->text('hasil_rekomendasi');
            $table->timestamps();

            $table->foreign('pengadaan_id')->references('id')
                ->on('pengadaan')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('sub_barang_id')->references('id')
                ->on('sub_barang')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengadaan_detail');
    }
}
