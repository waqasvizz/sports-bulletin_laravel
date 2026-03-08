<?php

   /**
    *  @author  DANISH HUSSAIN <danishhussain9525@hotmail.com>
    *  @link    Author Website: https://danishhussain.w3spaces.com/
    *  @link    Author LinkedIn: https://pk.linkedin.com/in/danish-hussain-285345123
    *  @since   2020-03-01
   **/
  
namespace Database\Seeders;

use Illuminate\Database\Seeder;
// use App\Models\User;
// use Spatie\Permission\Models\Permission;
// use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use DB;

use Exception;

class CategorieSeeder extends Seeder
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
                if(DB::table('categories')->count() == 0){
                    DB::table('categories')->insert([
                        [
                            'title' => 'HOCKEY',
                            'slug' => Str::slug('HOCKEY'),
                            'sort_order' => 1,
                            'status' => 'Published',
                            'created_at' => now(),	
                            'updated_at' => now(),
                        ],[
                            'title' => 'CRICKET',
                            'slug' => Str::slug('CRICKET'),
                            'sort_order' => 2,
                            'status' => 'Published',
                            'created_at' => now(),	
                            'updated_at' => now(),
                        ],[
                            'title' => 'TENNIS',
                            'slug' => Str::slug('TENNIS'),
                            'sort_order' => 3,
                            'status' => 'Published',
                            'created_at' => now(),	
                            'updated_at' => now(),
                        ],[
                            'title' => 'VOLLEYBALL',
                            'slug' => Str::slug('VOLLEYBALL'),
                            'sort_order' => 4,
                            'status' => 'Published',
                            'created_at' => now(),	
                            'updated_at' => now(),
                        ],[
                            'title' => 'CHESS',
                            'slug' => Str::slug('CHESS'),
                            'sort_order' => 5,
                            'status' => 'Published',
                            'created_at' => now(),	
                            'updated_at' => now(),
                        ],[
                            'title' => 'BASEBALL & BASKETBALL',
                            'slug' => Str::slug('BASEBALL & BASKETBALL'),
                            'sort_order' => 6,
                            'status' => 'Published',
                            'created_at' => now(),	
                            'updated_at' => now(),
                        ],[
                            'title' => 'ARCHERY',
                            'slug' => Str::slug('ARCHERY'),
                            'sort_order' => 7,
                            'status' => 'Published',
                            'created_at' => now(),	
                            'updated_at' => now(),
                        ],[
                            'title' => 'POLO',
                            'slug' => Str::slug('POLO'),
                            'sort_order' => 8,
                            'status' => 'Published',
                            'created_at' => now(),	
                            'updated_at' => now(),
                        ],
                    ]);

                } else { echo "<br>[Categories Table is not empty] "; }

            }catch(Exception $e) {
                echo $e->getMessage();
            }
            
    }
}