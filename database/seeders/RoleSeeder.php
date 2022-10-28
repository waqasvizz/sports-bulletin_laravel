<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Role::factory(10)->create();

        // check if table roles is empty

        try{
            if(DB::table('roles')->count() == 0){

                DB::table('roles')->insert([

                    [
                        'name' => 'Super Admin',
                        'guard_name' => 'web',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'name' => 'Admin',
                        'guard_name' => 'web',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]

                ]);
                
            } else { echo "<br>[Role Table is not empty] "; }

        }catch(Exception $e) {
            echo $e->getMessage();
        }
    }
}