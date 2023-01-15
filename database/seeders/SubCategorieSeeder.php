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

class SubCategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            try{
                if(DB::table('sub_categories')->count() == 0){
                    DB::table('sub_categories')->insert([
                        [
                            'title' => 'Int News',
                            'slug' => str_slug('Int News'),
                            'sort_order' => 1,
                            'category_id' => 8,
                            'status' => 'Published',
                            'created_at' => now(),	
                            'updated_at' => now(),
                        ],[
                            'title' => 'Local News',
                            'slug' => str_slug('Local News'),
                            'sort_order' => 2,
                            'category_id' => 8,
                            'status' => 'Published',
                            'created_at' => now(),	
                            'updated_at' => now(),
                        ],[
                            'title' => 'National News',
                            'slug' => str_slug('National News'),
                            'sort_order' => 3,
                            'category_id' => 8,
                            'status' => 'Published',
                            'created_at' => now(),	
                            'updated_at' => now(),
                        ],[
                            'title' => 'Blind',
                            'slug' => str_slug('Blind'),
                            'sort_order' => 1,
                            'category_id' => 7,
                            'status' => 'Published',
                            'created_at' => now(),	
                            'updated_at' => now(),
                        ],[
                            'title' => 'Int News',
                            'slug' => str_slug('Int News'),
                            'sort_order' => 2,
                            'category_id' => 7,
                            'status' => 'Published',
                            'created_at' => now(),	
                            'updated_at' => now(),
                        ],[
                            'title' => 'National News',
                            'slug' => str_slug('National News'),
                            'sort_order' => 3,
                            'category_id' => 7,
                            'status' => 'Published',
                            'created_at' => now(),	
                            'updated_at' => now(),
                        ],
                    ]);

                } else { echo "<br>[Sub Categories Table is not empty] "; }

            }catch(Exception $e) {
                echo $e->getMessage();
            }
            
    }
}