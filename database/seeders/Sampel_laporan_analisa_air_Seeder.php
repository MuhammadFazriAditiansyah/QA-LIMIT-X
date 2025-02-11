<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sampel_laporan_analisa_air;


class Sampel_laporan_analisa_air_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sampel = new Sampel_laporan_analisa_air(); 

        Sampel_laporan_analisa_air::create([
            'sampel'=>'Air Sumur', 
        ]);
        Sampel_laporan_analisa_air::create([
            'sampel'=>'Sand Filter', 
        ]);
        Sampel_laporan_analisa_air::create([
            'sampel'=>'Air Raw', 
        ]);
        Sampel_laporan_analisa_air::create([
            'sampel'=>'Air treatment activated carbon', 
        ]);
        Sampel_laporan_analisa_air::create([
            'sampel'=>'Air treatment softener', 
        ]);
        Sampel_laporan_analisa_air::create([
            'sampel'=>'Air soft setelah treatment filter 5 um', 
        ]);
        Sampel_laporan_analisa_air::create([
            'sampel'=>'Air treatment radiasi UV', 
        ]);
        Sampel_laporan_analisa_air::create([
            'sampel'=>'Air reverse osmosis', 
        ]);
    }
}
