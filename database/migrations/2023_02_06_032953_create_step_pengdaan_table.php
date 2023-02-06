<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStepPengdaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('step_pengdaan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pengadaan_id');
            $table->string('step');
            $table->longText('deskripsi');
            $table->string('status');
            $table->timestamps();

            $table->foreign('pengadaan_id')->references('id')
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
        Schema::dropIfExists('step_pengdaan');
    }
}
