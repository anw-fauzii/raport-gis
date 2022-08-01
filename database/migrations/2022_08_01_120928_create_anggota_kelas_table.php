<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnggotaKelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggota_kelas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('siswa_id')->unsigned();
            $table->unsignedBigInteger('kelas_id')->unsigned();
            $table->unsignedBigInteger('kelas_id')->unsigned();
            $table->enum('pendaftaran', ['1', '2', '3', '4', '5']);
            $table->timestamps();

            $table->foreign('siswa_id')->references('id')->on('siswa');
            $table->foreign('kelas_id')->references('id')->on('kelas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anggota_kelas');
    }
}
