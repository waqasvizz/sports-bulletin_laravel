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
                            'title' => 'Category 1',
                            'sort_order' => 1,
                            'status' => 'Published',
                            'created_at' => now(),	
                            'updated_at' => now(),
                        ],[
                            'title' => 'Category 2',
                            'sort_order' => 2,
                            'status' => 'Published',
                            'created_at' => now(),	
                            'updated_at' => now(),
                        ],[
                            'title' => 'Category 3',
                            'sort_order' => 3,
                            'status' => 'Published',
                            'created_at' => now(),	
                            'updated_at' => now(),
                        ],[
                            'title' => 'Category 4',
                            'sort_order' => 4,
                            'status' => 'Published',
                            'created_at' => now(),	
                            'updated_at' => now(),
                        ],[
                            'title' => 'Category 5',
                            'sort_order' => 5,
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