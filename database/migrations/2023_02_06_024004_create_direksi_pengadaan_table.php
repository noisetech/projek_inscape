<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDireksiPengadaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direksi_pengadaan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pengadaan_id');
            $table->string('nama');
            $table->string('dokumen');
            $table->string('status')->nullable();
            $table->timestamps();

            $table->foreign('pengadaan_id')
                ->references('id')
                ->on('pengadaan')
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
        Schema::dropIfExists('direksi_pengadaan');
    }
}
