<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKkmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kkm', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mapel_id')->unsigned();
            $table->unsignedBigInteger('tapel_id')->unsigned();
            $table->integer('tingkat');
            $table->integer('kkm');
            $table->timestamps();

            $table->foreign('mapel_id')->references('id')->on('mapel');
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
        Schema::dropIfExists('kkm');
    }
}
