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
                            'title' => 'Sub Category 1',
                            'sort_order' => 1,
                            'category_id' => 1,
                            'status' => 'Published',
                            'created_at' => now(),	
                            'updated_at' => now(),
                        ],[
                            'title' => 'Sub Category 2',
                            'sort_order' => 2,
                            'category_id' => 1,
                            'status' => 'Published',
                            'created_at' => now(),	
                            'updated_at' => now(),
                        ],[
                            'title' => 'Sub Category 3',
                            'sort_order' => 1,
                            'category_id' => 2,
                            'status' => 'Published',
                            'created_at' => now(),	
                            'updated_at' => now(),
                        ],[
                            'title' => 'Sub Category 4',
                            'sort_order' => 2,
                            'category_id' => 2,
                            'status' => 'Published',
                            'created_at' => now(),	
                            'updated_at' => now(),
                        ],[
                            'title' => 'Sub Category 5',
                            'sort_order' => 1,
                            'category_id' => 3,
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