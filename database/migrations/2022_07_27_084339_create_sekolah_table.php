<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSekolahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sekolah', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sekolah', 100);
            $table->string('npsn', 10);
            $table->string('kode_pos', 5);
            $table->string('nomor_telpon', 13)->nullable();
            $table->string('alamat');
            $table->string('website', 100)->nullable();
            $table->string('email', 35)->nullable();
            $table->string('logo')->nullable();
            $table->string('kepala_sekolah', 100);
            $table->string('nip_kepala_sekolah', 30)->nullable();
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
        Schema::dropIfExists('sekolah');
    }
}
