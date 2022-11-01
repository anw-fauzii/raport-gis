<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiHafalanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_hafalan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('anggota_kelas_id')->unsigned();
            $table->integer('tingkat');
            $table->integer('hadis')->nullable();
            $table->integer('doa')->nullable();
            $table->integer('hikmah')->nullable();
            $table->text('deskripsi_hadis')->nullable();
            $table->text('deskripsi_doa')->nullable();
            $table->text('deskripsi_hikmah')->nullable();
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
        Schema::dropIfExists('nilai_hafalan');
    }
}
