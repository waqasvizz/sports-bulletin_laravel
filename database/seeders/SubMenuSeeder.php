<?php

   /**
    *  @author  DANISH HUSSAIN <danishhussain9525@hotmail.com>
    *  @link    Author Website: https://danishhussain.w3spaces.com/
    *  @link    Author LinkedIn: https://pk.linkedin.com/in/danish-hussain-285345123
    *  @since   2020-03-01
   **/
  
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use DB;
use Exception;

class SubMenuSeeder extends Seeder
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
                if(DB::table('sub_menus')->count() == 0){
                    DB::table('sub_menus')->insert([
                        [
                            'menu_id' => 1,
                            'title' => 'Add',
                            'url' => '/role/create',
                            'slug' => 'role-create',
                            'sort_order' => 1,
                            'status' => 'Published',
                            'asset_type' => 'Icon',
                            'asset_value' => 'list',
                            'created_at' => now(),	
                            'updated_at' => now(),
                        ],
                        [
                            'menu_id' => 1,
                            'title' => 'List',
                            'url' => '/role',
                            'slug' => 'role-list',
                            'sort_order' => 2,
                            'status' => 'Published',
                            'asset_type' => 'Icon',
                            'asset_value' => 'list',
                            'created_at' => now(),	
                            'updated_at' => now(),
                        ],
                        [
                            'menu_id' => 2,
                            'title' => 'Add',
                            'url' => '/permission/create',
                            'slug' => 'permission-create',
                            'sort_order' => 1,
                            'status' => 'Published',
                            'asset_type' => 'Icon',
                            'asset_value' => 'user',
                            'created_at' => now(),	
                            'updated_at' => now(),
                        ],
                        [
                            'menu_id' => 2,
                            'title' => 'List',
                            'url' => '/permission',
                            'slug' => 'permission-list',
                            'sort_order' => 2,
                            'status' => 'Published',
                            'asset_type' => 'Icon',
                            'asset_value' => 'user',
                            'created_at' => now(),	
                            'updated_at' => now(),
                        ],
                        [
                            'menu_id' => 4,
                            'title' => 'Add',
                            'url' => '/user/create',
                            'slug' => 'user-create',
                            'sort_order' => 1,
                            'status' => 'Published',
                            'asset_type' => 'Icon',
                            'asset_value' => 'user',
                            'created_at' => now(),	
                            'updated_at' => now(),
                        ],
                        [
                            'menu_id' => 4,
                            'title' => 'List',
                            'url' => '/user',
                            'slug' => 'user-list',
                            'sort_order' => 2,
                            'status' => 'Published',
                            'asset_type' => 'Icon',
                            'asset_value' => 'user',
                            'created_at' => now(),	
                            'updated_at' => now(),
                        ],
                        [
                            'menu_id' => 5,
                            'title' => 'Add',
                            'url' => '/menu/create',
                            'slug' => 'menu-create',
                            'sort_order' => 1,
                            'status' => 'Published',
                            'asset_type' => 'Icon',
                            'asset_value' => 'list',
                            'created_at' => now(),	
                            'updated_at' => now(),
                        ],
                        [
                            'menu_id' => 5,
                            'title' => 'List',
                            'url' => '/menu',
                            'slug' => 'menu-list',
                            'sort_order' => 2,
                            'status' => 'Published',
                            'asset_type' => 'Icon',
                            'asset_value' => 'list',
                            'created_at' => now(),	
                            'updated_at' => now(),
                        ],
                        [
                            'menu_id' => 6,
                            'title' => 'Add',
                            'url' => '/sub_menu/create',
                            'slug' => 'sub-menu-create',
                            'sort_order' => 1,
                            'status' => 'Published',
                            'asset_type' => 'Icon',
                            'asset_value' => 'list',
                            'created_at' => now(),	
                            'updated_at' => now(),
                        ],
                        [
                            'menu_id' => 6,
                            'title' => 'List',
                            'url' => '/sub_menu',
                            'slug' => 'sub-menu-list',
                            'sort_order' => 2,
                            'status' => 'Published',
                            'asset_type' => 'Icon',
                            'asset_value' => 'list',
                            'created_at' => now(),	
                            'updated_at' => now(),
                        ],
                        [
                            'menu_id' => 7,
                            'title' => 'Add',
                            'url' => '/category/create',
                            'slug' => 'category-create',
                            'sort_order' => 1,
                            'status' => 'Published',
                            'asset_type' => 'Icon',
                            'asset_value' => 'list',
                            'created_at' => now(),	
                            'updated_at' => now(),
                        ],
                        [
                            'menu_id' => 7,
                            'title' => 'List',
                            'url' => '/category',
                            'slug' => 'category-list',
                            'sort_order' => 2,
                            'status' => 'Published',
                            'asset_type' => 'Icon',
                            'asset_value' => 'list',
                            'created_at' => now(),	
                            'updated_at' => now(),
                        ],
                        [
                            'menu_id' => 8,
                            'title' => 'Add',
                            'url' => '/sub_category/create',
                            'slug' => 'sub-category-create',
                            'sort_order' => 1,
                            'status' => 'Published',
                            'asset_type' => 'Icon',
                            'asset_value' => 'list',
                            'created_at' => now(),	
                            'updated_at' => now(),
                        ],
                        [
                            'menu_id' => 8,
                            'title' => 'List',
                            'url' => '/sub_category',
                            'slug' => 'sub-category-list',
                            'sort_order' => 2,
                            'status' => 'Published',
                            'asset_type' => 'Icon',
                            'asset_value' => 'list',
                            'created_at' => now(),	
                            'updated_at' => now(),
                        ],
                        [
                            'menu_id' => 9,
                            'title' => 'Add',
                            'url' => '/email_template/create',
                            'slug' => 'email-template-create',
                            'sort_order' => 1,
                            'status' => 'Published',
                            'asset_type' => 'Icon',
                            'asset_value' => 'mail',
                            'created_at' => now(),	
                            'updated_at' => now(),
                        ],
                        [
                            'menu_id' => 9,
                            'title' => 'List',
                            'url' => '/email_template',
                            'slug' => 'email-template-list',
                            'sort_order' => 2,
                            'status' => 'Published',
                            'asset_type' => 'Icon',
                            'asset_value' => 'mail',
                            'created_at' => now(),	
                            'updated_at' => now(),
                        ],
                        [
                            'menu_id' => 10,
                            'title' => 'Add',
                            'url' => '/short_codes/create',
                            'slug' => 'shortcode-create',
                            'sort_order' => 1,
                            'status' => 'Published',
                            'asset_type' => 'Icon',
                            'asset_value' => 'code',
                            'created_at' => now(),	
                            'updated_at' => now(),
                        ],
                        [
                            'menu_id' => 10,
                            'title' => 'List',
                            'url' => '/short_codes',
                            'slug' => 'shortcode-list',
                            'sort_order' => 2,
                            'status' => 'Published',
                            'asset_type' => 'Icon',
                            'asset_value' => 'code',
                            'created_at' => now(),	
                            'updated_at' => now(),
                        ],
                        [
                            'menu_id' => 11,
                            'title' => 'Add',
                            'url' => '/news/create',
                            'slug' => 'news-create',
                            'sort_order' => 1,
                            'status' => 'Published',
                            'asset_type' => 'Icon',
                            'asset_value' => 'menu',
                            'created_at' => now(),	
                            'updated_at' => now(),
                        ],
                        [
                            'menu_id' => 11,
                            'title' => 'List',
                            'url' => '/news',
                            'slug' => 'news-list',
                            'sort_order' => 2,
                            'status' => 'Published',
                            'asset_type' => 'Icon',
                            'asset_value' => 'menu',
                            'created_at' => now(),	
                            'updated_at' => now(),
                        ],
                        [
                            'menu_id' => 12,
                            'title' => 'Add',
                            'url' => '/blog/create',
                            'slug' => 'blog-create',
                            'sort_order' => 1,
                            'status' => 'Published',
                            'asset_type' => 'Icon',
                            'asset_value' => 'menu',
                            'created_at' => now(),	
                            'updated_at' => now(),
                        ],
                        [
                            'menu_id' => 12,
                            'title' => 'List',
                            'url' => '/blog',
                            'slug' => 'blog-list',
                            'sort_order' => 2,
                            'status' => 'Published',
                            'asset_type' => 'Icon',
                            'asset_value' => 'menu',
                            'created_at' => now(),	
                            'updated_at' => now(),
                        ],
                    ]);

                } else { echo "<br>[Sub Menus Table is not empty] "; }

            }catch(Exception $e) {
                echo $e->getMessage();
            }
            
    }
}