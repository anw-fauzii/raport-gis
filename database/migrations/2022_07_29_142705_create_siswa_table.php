<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique()->unsigned();
            $table->unsignedBigInteger('kelas_id')->unsigned()->nullable();
            $table->unsignedBigInteger('guru_id')->unsigned()->nullable();
            $table->enum('jenis_pendaftaran', ['1', '2']);
            $table->string('nis', 20)->unique();
            $table->string('nisn', 20)->unique()->nullable();
            $table->string('nama_lengkap', 100);
            $table->string('tempat_lahir', 50);
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->enum('agama', ['1', '2', '3', '4', '5', '6', '7']);
            $table->enum('status_dalam_keluarga', ['1', '2', '3']);
            $table->string('anak_ke', 2);
            $table->string('alamat');
            $table->string('nomor_hp', 13)->unique()->nullable();

            $table->string('nama_ayah', 100);
            $table->string('nama_ibu', 100);
            $table->string('pekerjaan_ayah', 100);
            $table->string('pekerjaan_ibu', 100);
            
            $table->string('pendidikan_ayah', 100);
            $table->string('pendidikan_ibu', 100);
            $table->string('nama_wali', 100)->nullable();
            $table->string('pekerjaan_wali', 100)->nullable();
            $table->string('pendidikan_wali', 100)->nullable();

            $table->string('avatar');
            $table->enum('status', ['1', '2', '3']);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('kelas_id')->references('id')->on('kelas');
            $table->foreign('guru_id')->references('id')->on('guru');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswa');
    }
}
