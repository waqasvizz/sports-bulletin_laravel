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
                            'first_name' => 'Vizz',
                            'last_name' => 'Super Admin',
                            'full_name' => 'Vizz Super Admin',
                            'user_type' => 'super-admin',
                            'email' => 'vizzsuperadmin@gmail.com',
                            'password' => bcrypt('12345678@w'),
                            'created_at' => now(),
                            'updated_at' => now(),
                        ],
                        [
                            'first_name' => 'Vizz',
                            'last_name' => 'Admin',
                            'full_name' => 'Vizz Admin',
                            'user_type' => 'admin',
                            'email' => 'vizzadmin@gmail.com',
                            'password' => bcrypt('12345678@w'),
                            'created_at' => now(),
                            'updated_at' => now(),
                        ],
                    ]);

                    $permissions = [
                        'user-list',
                        'user-create',
                        'user-edit',
                        'user-delete',
                        'user-status',
                        'role-list',
                        'role-create',
                        'role-edit',
                        'role-delete',
                        'permission-list',
                        'permission-create',
                        'permission-edit',
                        'permission-delete',
                        'menu-list',
                        'menu-create',
                        'menu-edit',
                        'menu-delete',
                        'sub-menu-list',
                        'sub-menu-create',
                        'sub-menu-edit',
                        'sub-menu-delete',
                        'assign-permission',
                        'email-message-list',
                        'email-message-create',
                        'email-message-edit',
                        'email-message-delete',
                        'shortcode-list',
                        'shortcode-create',
                        'shortcode-edit',
                        'shortcode-delete',
                        'category-list',
                        'category-create',
                        'category-edit',
                        'category-delete',
                        'sub-category-list',
                        'sub-category-create',
                        'sub-category-edit',
                        'sub-category-delete',
                        'news-list',
                        'news-create',
                        'news-edit',
                        'news-delete',
                    ];
                    
                    foreach ($permissions as $permission) {
                         Permission::create(['name' => $permission, 'guard_name' => 'web']);
                    }

                    $role = Role::where('name','Super Admin')->first();
                    $user = User::where('id', 1)->first();                     
                    $permissions = Permission::pluck('id','id')->all();
                    $role->syncPermissions($permissions);
                    $user->assignRole([$role->id]);

                    $role = Role::where('name','Admin')->first();
                    $user = User::where('id', 2)->first();                     
                    $permissions = Permission::whereIn('id',[31,32,33,34,35,36,37,38,39,40,41,42])->pluck('id','id')->all();
                    $role->syncPermissions($permissions);
                    $user->assignRole([$role->id]);

                } else { echo "<br>[User Table is not empty] "; }

            }catch(Exception $e) {
                echo $e->getMessage();
            }
            
    }
}