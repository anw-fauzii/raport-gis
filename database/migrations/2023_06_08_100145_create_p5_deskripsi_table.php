<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateP5DeskripsiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p5_deskripsi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('p5_id')->unsigned()->nullable();
            $table->string('dimensi');
            $table->text('judul');
            $table->text('deskripsi');
            $table->timestamps();

            $table->foreign('p5_id')->references('id')->on('p5');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('p5_deskripsi');
    }
}
