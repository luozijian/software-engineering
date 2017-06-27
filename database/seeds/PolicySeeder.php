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
                    'policy_number' => 'abc111',
                    'employee_id' => 1,
                    'client_name' => 'test',
                    'client_gender' => 0,
                    'client_phone' => '13144968111',
                    'client_email' => '2@qq.com',
                    'deal_amount' => 111,
                    'performance' => 123,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'deleted_at' => NULL,
                ],
                1=>[
                    'id' => 2,
                    'product_id' => 2,
                    'policy_number' => 'abc222',
                    'employee_id' => 2,
                    'client_name' => 'test',
                    'client_gender' => 0,
                    'client_phone' => '13144968111',
                    'client_email' => '2@qq.com',
                    'deal_amount' => 111,
                    'performance' => 123,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'deleted_at' => NULL,
                ],
                2=>[
                    'id' => 3,
                    'product_id' => 3,
                    'policy_number' => 'abc333',
                    'employee_id' => 3,
                    'client_name' => 'test',
                    'client_gender' => 0,
                    'client_phone' => '13144968111',
                    'client_email' => '2@qq.com',
                    'deal_amount' => 111,
                    'performance' => 123,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'deleted_at' => NULL,
                ],
                3=>[
                    'id' => 4,
                    'product_id' => 4,
                    'policy_number' => 'abc444',
                    'employee_id' => 1,
                    'client_name' => 'test',
                    'client_gender' => 0,
                    'client_phone' => '13144968111',
                    'client_email' => '2@qq.com',
                    'deal_amount' => 111,
                    'performance' => 123,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'deleted_at' => NULL,
                ],
                4=>[
                    'id' => 5,
                    'product_id' => 5,
                    'policy_number' => 'abc555',
                    'employee_id' => 1,
                    'client_name' => 'test',
                    'client_gender' => 0,
                    'client_phone' => '13144968111',
                    'client_email' => '2@qq.com',
                    'deal_amount' => 111,
                    'performance' => 123,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'deleted_at' => NULL,
                ],
            ]
        );
    }
}
