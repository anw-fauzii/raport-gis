<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiMulokTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_mulok', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rencana_mulok_id')->unsigned();
            $table->unsignedBigInteger('anggota_kelas_id')->unsigned();
            $table->integer('nilai_ph');
            $table->integer('nilai_pts');
            $table->integer('nilai_pas');
            $table->timestamps();

            $table->foreign('rencana_mulok_id')->references('id')->on('rencana_mulok');
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
        Schema::dropIfExists('nilai_mulok');
    }
}
