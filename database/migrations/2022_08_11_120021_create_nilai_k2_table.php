<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiK2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_k2', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rencana_nilai_k2_id')->unsigned();
            $table->unsignedBigInteger('anggota_kelas_id')->unsigned();
            $table->enum('nilai', ['1', '2', '3', '4']);
            $table->timestamps();

            $table->foreign('rencana_nilai_k2_id')->references('id')->on('rencana_nilai_k2');
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
        Schema::dropIfExists('nilai_k2');
    }
}
