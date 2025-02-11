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
        Schema::create('futamis', function (Blueprint $table) {
            $table->id();
            $table->string('nodokumen');
            $table->string('pemberi_sampel');
            $table->string('parameter_pengujian')->nullable();
            $table->string('parameter_pengujian_c2')->nullable();
            $table->string('parameter_pengujian_c3')->nullable();
            $table->string('parameter_pengujian_c4')->nullable();
            $table->string('jumlah_sampel');
            $table->date('tanggal_terima');
            $table->date('tanggal_uji');
            $table->date('tanggal_selesai'); 
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
            $table->date('return_date')->nullable(); 
            $table->date('done_time')->nullable(); 
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
        Schema::dropIfExists('futamis');
    }
};
