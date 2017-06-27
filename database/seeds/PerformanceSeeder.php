<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PerformanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('performances')->delete();

        \DB::table('performances')->insert(
            [
                0=>[
                    'id' => 1,
                    'product_id' => 1,
                    'policy_id' => 1,
                    'employee_id' => 1,
                    'job_point' => 3.2,
                    'deal_amount' => 0,
                    'release_amount' => 10,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'deleted_at' => NULL,
                ],
                1=>[
                    'id' => 2,
                    'product_id' => 2,
                    'policy_id' => 2,
                    'employee_id' => 2,
                    'job_point' => 3.2,
                    'deal_amount' => 0,
                    'release_amount' => 10,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'deleted_at' => NULL,
                ],
                2=>[
                    'id' => 3,
                    'product_id' => 3,
                    'policy_id' => 3,
                    'employee_id' => 3,
                    'job_point' => 3.2,
                    'deal_amount' => 0,
                    'release_amount' => 10,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'deleted_at' => NULL,
                ],
                3=>[
                    'id' => 4,
                    'product_id' => 4,
                    'policy_id' => 4,
                    'employee_id' => 1,
                    'job_point' => 3.2,
                    'deal_amount' => 0,
                    'release_amount' => 10,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'deleted_at' => NULL,
                ],
                4=>[
                    'id' => 5,
                    'product_id' => 5,
                    'policy_id' => 5,
                    'employee_id' => 1,
                    'job_point' => 3.2,
                    'deal_amount' => 0,
                    'release_amount' => 10,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'deleted_at' => NULL,
                ],
            ]
        );
    }
}
