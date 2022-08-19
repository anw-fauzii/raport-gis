<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiK3Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_k3', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rencana_nilai_k3_id')->unsigned();
            $table->unsignedBigInteger('anggota_kelas_id')->unsigned();
            $table->integer('nilai_ph');
            $table->integer('nilai_pts');
            $table->integer('nilai_pas');
            $table->timestamps();

            $table->foreign('rencana_nilai_k3_id')->references('id')->on('rencana_nilai_k3');
            $table->foreign('anggota_kelas_id')->references('id')->on('anggota_kelas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nilai_k3');
    }
}
