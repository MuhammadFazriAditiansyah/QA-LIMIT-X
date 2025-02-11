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
        Schema::create('mikrobiologi_kimia_sensoris', function (Blueprint $table) {
            $table->id();
            $table->string('nodokumen');
            $table->date('tgl_produksi');
            $table->string('nama_produk');
            $table->string('jumlah_batch');
            $table->string('keterangan')->nullable();

            $table->string('parameter_c1')->nullable();
            $table->string('parameter_c2')->nullable();
            $table->string('parameter_c3')->nullable();
            $table->string('parameter_c4')->nullable();
            $table->string('parameter_c5')->nullable();
            $table->string('parameter_c6')->nullable();
            $table->string('parameter_c7')->nullable();
            $table->string('parameter_c8')->nullable();
            $table->string('parameter_c9')->nullable();
            $table->string('parameter_c10')->nullable();
            $table->string('satuan_c1')->nullable();
            $table->string('satuan_c2')->nullable();
            $table->string('satuan_c3')->nullable();
            $table->string('satuan_c4')->nullable();
            $table->string('satuan_c5')->nullable();
            $table->string('satuan_c6')->nullable();
            $table->string('satuan_c7')->nullable();
            $table->string('satuan_c8')->nullable();
            $table->string('satuan_c9')->nullable();
            $table->string('satuan_c10')->nullable();



            $table->string('statusOP');
            $table->string('statusST');
            $table->string('statusSP');
            $table->string('user_id_OP')->nullable();
            $table->string('name_id_OP')->nullable();
            $table->string('user_id_ST')->nullable();
            $table->string('name_id_ST')->nullable();
            $table->string('user_id_SP')->nullable();
            $table->string('name_id_SP')->nullable();
            $table->string('created_at_OP')->nullable();
            $table->string('created_at_ST')->nullable();
            $table->string('created_at_SP')->nullable();
            $table->string('delete')->nullable();
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
        Schema::dropIfExists('mikrobiologi_kimia_sensoris');
    }
};
