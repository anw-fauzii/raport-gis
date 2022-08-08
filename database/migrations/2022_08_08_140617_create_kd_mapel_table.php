<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKdMapelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kd_mapel', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mapel_id')->unsigned();
            $table->string('tingkatan_kelas', 2);
            $table->enum('jenis_kompetensi', ['1', '2']);
            $table->enum('semester', ['1', '2']);
            $table->string('kode_kd', 10);
            $table->string('kompetensi_dasar');
            $table->timestamps();

            $table->foreign('mapel_id')->references('id')->on('mapel');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kd_mapel');
    }
}
