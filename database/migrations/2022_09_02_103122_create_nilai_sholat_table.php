<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiSholatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_sholat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('anggota_kelas_id')->unsigned();
            $table->integer('tingkat');
            $table->integer('praktik_wudhu')->nullable();
            $table->integer('bacaan_sholat')->nullable();
            $table->integer('gerakan_sholat')->nullable();
            $table->integer('dzikir')->nullable();
            $table->text('deskripsi_praktik_wudhu')->nullable();
            $table->text('deskripsi_bacaan_sholat')->nullable();
            $table->text('deskripsi_gerakan_sholat')->nullable();
            $table->text('deskripsi_dzikir')->nullable();
            $table->timestamps();
            
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
        Schema::dropIfExists('nilai_sholat');
    }
}
