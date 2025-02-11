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
        Schema::create('laporan_analisa_airs', function (Blueprint $table) {
            $table->id();
            $table->string('nodokumen');
            $table->date('tgl_sampling');
            // $table->string('sampel_1')->nullable();
            // $table->string('sampel_2')->nullable();
            // $table->string('sampel_3')->nullable();
            // $table->string('sampel_4')->nullable();
            // $table->string('sampel_5')->nullable();
            // $table->string('sampel_6')->nullable();
            // $table->string('sampel_7')->nullable();
            // $table->string('sampel_8')->nullable();
            // $table->string('sampel_9')->nullable();
            // $table->string('sampel_10')->nullable();
            // $table->string('sampel_11')->nullable();
            // $table->string('sampel_12')->nullable();
            // $table->string('sampel_13')->nullable();


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
        Schema::dropIfExists('laporan_analisa_airs');
    }
};
