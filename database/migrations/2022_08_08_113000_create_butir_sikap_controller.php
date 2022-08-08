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
        Schema::create('butir_sikap_controller', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis_kompetensi', ['1', '2']);
            $table->string('kode', 10)->unique();
            $table->string('butir_sikap');
            $table->timestamps();
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
