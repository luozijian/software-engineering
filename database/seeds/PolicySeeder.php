<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('policies')->delete();

        \DB::table('policies')->insert(
            [
                0=>[
                    'id' => 1,
                    'product_id' => 1,
                    'employee_id' => 1,
                    'policy_number' => 111,
                    'client_name' => '测试人员1',
                    'client_gender' => 1,
                    'client_phone' => '12345678901',
                    'client_email' => '111@qq.com',
                    'job_point' => 3.2,
                    'deal_amount' => 100,
                    'performance' => 100,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'deleted_at' => NULL,
                ],
                1=>[
                    'id' => 2,
                    'product_id' => 2,
                    'employee_id' => 2,
                    'policy_number' => 222,
                    'client_name' => '测试人员2',
                    'client_gender' => 0,
                    'client_phone' => '12345678902',
                    'client_email' => '222@qq.com',
                    'job_point' => 3.2,
                    'deal_amount' => 100,
                    'performance' => 100,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'deleted_at' => NULL,
                ],
                2=>[
                    'id' => 3,
                    'product_id' => 3,
                    'employee_id' => 3,
                    'policy_number' => 333,
                    'client_name' => '测试人员3',
                    'client_gender' => 1,
                    'client_phone' => '12345678903',
                    'client_email' => '333@qq.com',
                    'job_point' => 3.2,
                    'deal_amount' => 100,
                    'performance' => 100,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'deleted_at' => NULL,
                ],
                3=>[
                    'id' => 4,
                    'product_id' => 4,
                    'employee_id' => 4,
                    'policy_number' => 444,
                    'client_name' => '测试人员4',
                    'client_gender' => 1,
                    'client_phone' => '12345678904',
                    'client_email' => '444@qq.com',
                    'job_point' => 3.2,
                    'deal_amount' => 100,
                    'performance' => 100,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'deleted_at' => NULL,
                ],
                4=>[
                    'id' => 5,
                    'product_id' => 5,
                    'employee_id' => 5,
                    'policy_number' => 555,
                    'client_name' => '测试人员5',
                    'client_gender' => 0,
                    'client_phone' => '12345678905',
                    'client_email' => '555@qq.com',
                    'job_point' => 3.2,
                    'deal_amount' => 100,
                    'performance' => 100,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'deleted_at' => NULL,
                ],
            ]
        );
    }
}
