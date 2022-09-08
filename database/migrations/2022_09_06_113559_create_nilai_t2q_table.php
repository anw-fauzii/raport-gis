<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiT2qTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_t2q', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('anggota_kelas_id')->unsigned();
            $table->integer('tingkat');
            $table->string('tahsin_jilid')->nullable();
            $table->string('tahsin_halaman')->nullable();
            $table->string('tahsin_kekurangan')->nullable();
            $table->string('tahsin_kelebihan')->nullable();
            $table->integer('tahsin_nilai')->nullable();
            $table->string('tahfidz_surah')->nullable();
            $table->string('tahfidz_ayat')->nullable();
            $table->integer('tahfidz_nilai')->nullable();
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
        Schema::dropIfExists('nilai_t2q');
    }
}
