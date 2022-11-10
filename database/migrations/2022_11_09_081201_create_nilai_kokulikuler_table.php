<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiKokulikulerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_kokulikuler', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rencana_kokulikuler_id')->unsigned();
            $table->unsignedBigInteger('anggota_kelas_id')->unsigned();
            $table->integer('nilai_ph');
            $table->integer('nilai_pts');
            $table->integer('nilai_pas');
            $table->integer('nilai_kd');
            $table->timestamps();

            $table->foreign('rencana_kokulikuler_id')->references('id')->on('rencana_kokulikuler');
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
        Schema::dropIfExists('nilai_kokulikuler');
    }
}
