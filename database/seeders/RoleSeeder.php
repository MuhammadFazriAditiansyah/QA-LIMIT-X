<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;



class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role(); 

        Role::create([
            'name'=>'operator'
        ]);
    
        Role::create([
            'name'=>'staff'
        ]);
    
        Role::create([
            'name'=>'supervisor'
        ]);
    
        Role::create([
            'name'=>'superadmin'
        ]);
        Role::create([
            'name'=>'qa_product_release'
        ]);
    }
}
