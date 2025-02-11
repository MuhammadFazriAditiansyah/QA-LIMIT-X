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
        Schema::create('parameter_pengujians', function (Blueprint $table) {
            $table->id();
            // $table->string('nama_parameter');
            // $table->string('catatan')->nullable();

            // $table->string('satuan_acidity')->nullable();
            // $table->string('satuan_volume')->nullable();
            // $table->string('keterangan')->nullable();

            $table->string('parameter')->nullable();
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
        Schema::dropIfExists('parameter_pengujians');
    }
};
