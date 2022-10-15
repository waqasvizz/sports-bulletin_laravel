<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use DB;
use Exception;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();

        // check if table users is empty

            try{
                if(DB::table('users')->count() == 0){
                    DB::table('users')->insert([

                        [
                            'role' => 1,
                            'first_name' => 'Vizz',
                            'last_name' => 'Vizz Admin',
                            'email' => 'vizzadmin@gmail.com',
                            'password' => bcrypt('12345678@w'),
                            'created_at' => now(),
                            'updated_at' => now(),
                        ],
                        [
                            'role' => 2,
                            'first_name' => 'Vizz',
                            'last_name' => 'Client',
                            'email' => 'vizzclient@gmail.com',
                            'password' => bcrypt('12345678@w'),
                            'created_at' => now(),
                            'updated_at' => now(),
                        ],
                        [
                            'role' => 3,
                            'first_name' => 'Vizz',
                            'last_name' => 'Staff',
                            'email' => 'vizzstaff@gmail.com',
                            'password' => bcrypt('12345678@w'),
                            'created_at' => now(),
                            'updated_at' => now(),
                        ],
                        [
                            'role' => 3,
                            'first_name' => 'Vizz',
                            'last_name' => 'sales',
                            'email' => 'sales@urbanpods.co.uk',
                            'password' => bcrypt('12345678@w'),
                            'created_at' => now(),
                            'updated_at' => now(),
                        ],
                        [
                            'role' => 3,
                            'first_name' => 'Vizz',
                            'last_name' => 'foreman',
                            'email' => 'foreman@urbanpods.co.uk',
                            'password' => bcrypt('12345678@w'),
                            'created_at' => now(),
                            'updated_at' => now(),
                        ],
                        [
                            'role' => 3,
                            'first_name' => 'Vizz',
                            'last_name' => 'customercare',
                            'email' => 'customercare@urbanpods.co.uk',
                            'password' => bcrypt('12345678@w'),
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]
                    ]);
                } else { echo "<br>[User Table is not empty] "; }

            }catch(Exception $e) {
                echo $e->getMessage();
            }
            
    }
}