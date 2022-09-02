<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRencanaNilaiSholatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rencana_nilai_sholat', function (Blueprint $table) {
            $table->id();
            $table->integer('tingkat');
            $table->unsignedBigInteger('guru_id')->unsigned()->nullable();
            $table->integer('kategori');
            $table->unsignedBigInteger('butir_sikap_id')->unsigned();
            $table->timestamps();

            $table->foreign('guru_id')->references('id')->on('guru');
            $table->foreign('butir_sikap_id')->references('id')->on('butir_sikap');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rencana_nilai_sholat');
    }
}
