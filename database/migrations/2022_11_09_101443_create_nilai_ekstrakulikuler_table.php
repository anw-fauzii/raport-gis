<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiEkstrakulikulerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_ekstrakulikuler', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ekstrakulikuler_id')->unsigned();
            $table->unsignedBigInteger('anggota_ekstrakulikuler_id')->unsigned();
            $table->enum('nilai', ['4', '3', '2', '1']);
            $table->string('deskripsi', 200);
            $table->timestamps();

            $table->foreign('ekstrakulikuler_id')->references('id')->on('ekstrakulikuler');
            $table->foreign('anggota_ekstrakulikuler_id')->references('id')->on('anggota_ekstrakulikuler');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nilai_ekstrakulikuler');
    }
}
