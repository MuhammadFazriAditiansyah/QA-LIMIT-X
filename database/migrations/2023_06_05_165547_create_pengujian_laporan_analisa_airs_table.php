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
        Schema::create('pengujian_laporan_analisa_airs', function (Blueprint $table) {
            $table->id();
            $table->string('id_analisa_air')->nullable();
            $table->string('sampel_id')->nullable();
            
            $table->string('pengujian')->nullable();
            $table->string('shift_1')->nullable();
            $table->string('shift_2')->nullable();
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
        Schema::dropIfExists('pengujian_laporan_analisa_airs');
    }
};
