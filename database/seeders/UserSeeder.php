<?php

namespace Database\Seeders;

use App\Models\Sampel_mikrobiologi_air;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Futami_sampel_kimia;
use App\Models\Sampel_mikrobiologi_produk;
use App\Models\Sampel_mikrobiologi_produk_percobaan;
use App\Models\Sampel_mikrobiologi_proses_produksi;
use App\Models\Sampel_mikrobiologi_bahan_baku;
use App\Models\Sampel_mikrobiologi_bahan_kemas;
use App\Models\Sampel_mikrobiologi_ruangan;
use App\Models\Sampel_mikrobiologi_personil;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sampel = new Futami_sampel_kimia();
        $sampel = new Sampel_mikrobiologi_air();
        $sampel = new Sampel_mikrobiologi_produk();
        $sampel = new Sampel_mikrobiologi_proses_produksi();
        $sampel = new Sampel_mikrobiologi_produk_percobaan();
        $sampel = new Sampel_mikrobiologi_bahan_baku();
        $sampel = new Sampel_mikrobiologi_bahan_kemas();
        $sampel = new Sampel_mikrobiologi_ruangan();
        $sampel = new Sampel_mikrobiologi_personil();
        

        
        $user = new User();

        User::create([
            'role_id'=>'1',
            'nama'=>'Operator',
            'nohp'=>'085890029097',
            'email'=>'operator@gmail.com',
            'password'=>bcrypt('operator'),
            'jabatan'=>'1',
            'alamat'=>'Jln Raya Sukabumi, Km17, Rt3/Rw2, Desa Caringin, Kec. Caringin, Kab.Bogor, 16730 ',
            'status' => '0'
        ]);

        User::create([
            'role_id'=>'2',
            'nama'=>'Staff',
            'nohp'=>'1234567890',
            'email'=>'staff@gmail.com',
            'password'=>bcrypt('staff'),
            'jabatan'=>'2',
            'alamat'=>'Jln Raya Sukabumi, Km17, Rt3/Rw2, Desa Caringin, Kec. Caringin, Kab.Bogor, 16730 ',
            'status' => '0'
        ]);

        User::create([
            'role_id'=>'3',
            'nama'=>'Super Visor',
            'nohp'=>'01234567890',
            'email'=>'supervisor@gmail.com',
            'password'=>bcrypt('supervisor'),
            'jabatan'=>'3',
            'alamat'=>'Jln Raya Sukabumi, Km17, Rt3/Rw2, Desa Caringin, Kec. Caringin, Kab.Bogor, 16730 ',
            'status' => '0'
        ]);

        User::create([
            'role_id'=>'4',
            'nama'=>'Super Admin',
            'nohp'=>'0987654321',
            'email'=>'superadmin@gmail.com',
            'password'=>bcrypt('superadmin'),
            'jabatan'=>'4',
            'alamat'=>'Jln Raya Sukabumi, Km17, Rt3/Rw2, Desa Caringin, Kec. Caringin, Kab.Bogor, 16730 ',
            'status' => '0'
        ]);

        User::create([
            'role_id'=>'5',
            'nama'=>'Qa Product release',
            'nohp'=>'09876543211',
            'email'=>'qaproductrelease@gmail.com',
            'password'=>bcrypt('qaleader'),
            'jabatan'=>'5',
            'alamat'=>'Jln Raya Sukabumi, Km17, Rt3/Rw2, Desa Caringin, Kec. Caringin, Kab.Bogor, 16730 ',
            'status' => '0'
        ]);
    }
}
