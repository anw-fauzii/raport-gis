<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMapelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mapel', function (Blueprint $table) {
            $table->id();
            $table->string('tapel', 20);
            $table->unsignedBigInteger('kategori_mapel_id')->unsigned();
            $table->string('nama_mapel');
            $table->string('ringkasan_mapel')->nullable();
            $table->timestamps();

            $table->foreign('kategori_mapel_id')->references('id')->on('kategori_mapel');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mapel');
    }
}
