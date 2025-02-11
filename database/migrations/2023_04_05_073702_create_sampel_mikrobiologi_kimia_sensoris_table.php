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
        Schema::create('sampel_mikrobiologi_kimia_sensoris', function (Blueprint $table) {
            $table->id();
            $table->string('id_kimia_sensori')->nullable();
            $table->string('kode_sampling');
            $table->time('waktu');
            $table->date('exp_date');
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

            // $table->string('penampakan');
            // $table->string('endapan');
            // $table->string('warna');
            // $table->string('rasa');
            // $table->string('aroma');
            // $table->string('brix');
            // $table->string('acidity');
            // $table->string('ph');
            // $table->string('density');
            // $table->string('volume');
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
        Schema::dropIfExists('sampel_mikrobiologi_kimia_sensoris');
    }
};
