<?php

   /**
    *  @author  DANISH HUSSAIN <danishhussain9525@hotmail.com>
    *  @link    Author Website: https://danishhussain.w3spaces.com/
    *  @link    Author LinkedIn: https://pk.linkedin.com/in/danish-hussain-285345123
    *  @since   2020-03-01
   **/
  
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ShortCode;
use DB;
use Exception;

class ShortCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

            try{
                if(DB::table('short_codes')->count() == 0){
                    DB::table('short_codes')->insert([

                        [
                            'title' => '[sales_date_time]',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ],
                        [
                            'title' => '[user_name]',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ],
                        [
                            'title' => '[invoice_number]',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ],
                        [
                            'title' => '[invoice_preferred_model_pod]',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ],
                        [
                            'title' => '[received_payment_with_discount]',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ],
                        [
                            'title' => '[received_payment_via_card]',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ],
                        [
                            'title' => '[installation_date_time]',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ],
                        [
                            'title' => '[login_url]',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ],
                        [
                            'title' => '[invoice_link]',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ],

                    ]);
                } else { echo "<br>[Short Code Table is not empty] "; }

            }catch(Exception $e) {
                echo $e->getMessage();
            }
            
    }
}
