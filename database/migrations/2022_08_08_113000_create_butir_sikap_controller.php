<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateButirSikapController extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('butir_sikap', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kategori_butir_id')->unsigned();
            $table->string('kode', 10)->unique();
            $table->string('butir_sikap');
            $table->timestamps();

            $table->foreign('kategori_butir_id')->references('id')->on('kategori_butir');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('butir_sikap_controller');
    }
}
