<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiTahfidzTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_tahfidz', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('anggota_kelas_id')->unsigned();
            $table->integer('tingkat');
            $table->text('tahfidz_surah')->nullable();
            $table->text('tahfidz_kelebihan')->nullable();
            $table->text('tahfidz_kekurangan')->nullable();
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
        Schema::dropIfExists('nilai_tahfidz');
    }
}
