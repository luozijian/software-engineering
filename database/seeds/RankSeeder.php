<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('ranks')->delete();

        \DB::table('ranks')->insert(
            [
                0=>[
                    'id' => 1,
                    'name' => '服务员',
                    'job_point' => 1.7,
                    'performance_required' => 10,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'deleted_at' => NULL,
                ],
                1=>[
                    'id' => 2,
                    'name' => '销售员',
                    'job_point' => 2.0,
                    'performance_required' => 20,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'deleted_at' => NULL,
                ],
                2=>[
                    'id' => 3,
                    'name' => '讲师',
                    'job_point' => 2.3,
                    'performance_required' => 80,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'deleted_at' => NULL,
                ],
                3=>[
                    'id' => 4,
                    'name' => '经理',
                    'job_point' => 2.6,
                    'performance_required' => 100,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'deleted_at' => NULL,
                ],
                4=>[
                    'id' => 5,
                    'name' => '总监',
                    'job_point' => 2.9,
                    'performance_required' => 120,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'deleted_at' => NULL,
                ],
                5=>[
                    'id' => 6,
                    'name' => '总裁',
                    'job_point' => 3.2,
                    'performance_required' => 0,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'deleted_at' => NULL,
                ],
            ]
        );
    }
}
