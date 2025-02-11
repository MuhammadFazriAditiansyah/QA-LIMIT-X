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
        Schema::create('futami_sampel_kimias', function (Blueprint $table) {
            $table->id();
            $table->string('sampel');
            $table->string('id_analisa_kimia')->nullable();
            $table->string('parameter_nilaiuji')->nullable();
            $table->string('parameter_nilaiuji_c2')->nullable();
            $table->string('parameter_nilaiuji_c3')->nullable();
            $table->string('parameter_nilaiuji_c4')->nullable();
            $table->string('spesifikasi')->nullable();
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
        Schema::dropIfExists('futami_sampel_kimias');
    }
};
