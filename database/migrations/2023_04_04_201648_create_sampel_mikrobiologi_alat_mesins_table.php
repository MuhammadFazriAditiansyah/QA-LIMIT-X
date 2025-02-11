<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sampel_mikrobiologi_alat_mesins', function (Blueprint $table) {
            $table->id();
            $table->string('id_alat_mesin')->nullable();
            $table->string('nama_objek');
            $table->time('jam_sampling');
            $table->string('tpc');
            $table->string('yeast_mold');
            $table->string('coliform');
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('sampel_mikrobiologi_alat_mesins');
    }
};
