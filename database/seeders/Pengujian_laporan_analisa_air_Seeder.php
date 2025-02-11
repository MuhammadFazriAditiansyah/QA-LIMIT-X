<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pengujian_database;

class Pengujian_laporan_analisa_air_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pengujian = new Pengujian_database(); 

        Pengujian_database::create([
            'pengujian_id' => '1',
            'pengujian' => 'Penampakan',
        ]);
        Pengujian_database::create([
            'pengujian_id' => '1',
            'pengujian' => 'Warna',
        ]);
        Pengujian_database::create([
            'pengujian_id' => '1',
            'pengujian' => 'Rasa',
        ]);
        Pengujian_database::create([
            'pengujian_id' => '1',
            'pengujian' => 'Aroma',
        ]);
        Pengujian_database::create([
            'pengujian_id' => '1',
            'pengujian' => 'Kesadahan',
        ]);
        Pengujian_database::create([
            'pengujian_id' => '1',
            'pengujian' => 'pH',
        ]);
        


        Pengujian_database::create([
            'pengujian_id' => '2',
            'pengujian' => 'Penampakan',
        ]);
        Pengujian_database::create([
            'pengujian_id' => '2',
            'pengujian' => 'Warna',
        ]);
        Pengujian_database::create([
            'pengujian_id' => '2',
            'pengujian' => 'Rasa',
        ]);
        Pengujian_database::create([
            'pengujian_id' => '2',
            'pengujian' => 'Aroma',
        ]);
        Pengujian_database::create([
            'pengujian_id' => '2',
            'pengujian' => 'pH',
        ]);
        Pengujian_database::create([
            'pengujian_id' => '2',
            'pengujian' => 'Kekeruhan',
        ]);




        Pengujian_database::create([
            'pengujian_id' => '3',
            'pengujian' => 'Warna',
        ]);
        Pengujian_database::create([
            'pengujian_id' => '3',
            'pengujian' => 'Kadar klorin bebas 1 (ppm)',
        ]);
        Pengujian_database::create([
            'pengujian_id' => '3',
            'pengujian' => 'Kadar klorin bebes 2 (ppm)',
        ]);
        Pengujian_database::create([
            'pengujian_id' => '3',
            'pengujian' => 'pH',
        ]);





        Pengujian_database::create([
            'pengujian_id' => '4',
            'pengujian' => 'Penampakan',
        ]);
        Pengujian_database::create([
            'pengujian_id' => '4',
            'pengujian' => 'Warna',
        ]);
        Pengujian_database::create([
            'pengujian_id' => '4',
            'pengujian' => 'Aroma',
        ]);
        Pengujian_database::create([
            'pengujian_id' => '4',
            'pengujian' => 'Rasa',
        ]);
        Pengujian_database::create([
            'pengujian_id' => '4',
            'pengujian' => 'Kadar klorin bebas (ppm)',
        ]);
        Pengujian_database::create([
            'pengujian_id' => '4',
            'pengujian' => 'pH',
        ]);
        Pengujian_database::create([
            'pengujian_id' => '4',
            'pengujian' => 'Kekeruhan',
        ]);





        Pengujian_database::create([
            'pengujian_id' => '5',
            'pengujian' => 'Penampakan',
        ]);
        Pengujian_database::create([
            'pengujian_id' => '5',
            'pengujian' => 'Warna',
        ]);
        Pengujian_database::create([
            'pengujian_id' => '5',
            'pengujian' => 'Aroma',
        ]);
        Pengujian_database::create([
            'pengujian_id' => '5',
            'pengujian' => 'Rasa',
        ]);
        Pengujian_database::create([
            'pengujian_id' => '5',
            'pengujian' => 'Kesadahan',
        ]);
        Pengujian_database::create([
            'pengujian_id' => '5',
            'pengujian' => 'pH',
        ]);




        Pengujian_database::create([
            'pengujian_id' => '6',
            'pengujian' => 'Penampakan',
        ]);
        Pengujian_database::create([
            'pengujian_id' => '6',
            'pengujian' => 'Warna',
        ]);
        Pengujian_database::create([
            'pengujian_id' => '6',
            'pengujian' => 'Aroma',
        ]);
        Pengujian_database::create([
            'pengujian_id' => '6',
            'pengujian' => 'Rasa',
        ]);
        Pengujian_database::create([
            'pengujian_id' => '6',
            'pengujian' => 'Kesadahan',
        ]);
        Pengujian_database::create([
            'pengujian_id' => '6',
            'pengujian' => 'pH',
        ]);
        Pengujian_database::create([
            'pengujian_id' => '6',
            'pengujian' => 'Kadar kalorin bebas (ppm)',
        ]);
        Pengujian_database::create([
            'pengujian_id' => '6',
            'pengujian' => 'Kekeruhan (NTU)',
        ]);




        
        Pengujian_database::create([
            'pengujian_id' => '7',
            'pengujian' => 'Penampakan',
        ]);
        Pengujian_database::create([
            'pengujian_id' => '7',
            'pengujian' => 'Warna',
        ]);
        Pengujian_database::create([
            'pengujian_id' => '7',
            'pengujian' => 'Aroma',
        ]);
        Pengujian_database::create([
            'pengujian_id' => '7',
            'pengujian' => 'Rasa',
        ]);
        Pengujian_database::create([
            'pengujian_id' => '7',
            'pengujian' => 'pH',
        ]);




        Pengujian_database::create([
            'pengujian_id' => '8',
            'pengujian' => 'Conductivity (mikroSiemen/cm)',
        ]);
        Pengujian_database::create([
            'pengujian_id' => '8',
            'pengujian' => 'pH',
        ]);


    }
}
