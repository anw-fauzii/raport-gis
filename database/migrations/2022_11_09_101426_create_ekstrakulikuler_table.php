<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEkstrakulikulerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ekstrakulikuler', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tapel_id')->unsigned();
            $table->unsignedBigInteger('guru_id')->unsigned();
            $table->string('nama_ekstrakulikuler', 30);
            $table->timestamps();

            $table->foreign('guru_id')->references('id')->on('guru');
            $table->foreign('tapel_id')->references('id')->on('tapel');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ekstrakulikuler');
    }
}
