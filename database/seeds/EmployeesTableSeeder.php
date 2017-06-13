<?php

use Illuminate\Database\Seeder;

class EmployeesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('employees')->delete();
        
        \DB::table('employees')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 2,
                'rank_id' => 6,
                'boss_id' => 0,
                'work_id' => 'LZJ2001',
                'name' => '罗子健',
                'phone' => '15889621385',
                'email' => 'LZJ2001@qq.com',
                'performance' => 100,
                'status' => 'on',
                'created_at' => '2017-05-22 06:56:37',
                'updated_at' => '2017-05-22 06:56:37',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 3,
                'rank_id' => 2,
                'boss_id' => 1,
                'work_id' => 'ZZP2002',
                'name' => '曾志平',
                'phone' => '15889715181',
                'email' => 'zzp@qq.com',
                'performance' => 100,
                'status' => 'on',
                'created_at' => '2017-05-22 06:57:55',
                'updated_at' => '2017-05-22 06:57:55',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 4,
                'rank_id' => 2,
                'boss_id' => 2,
                'work_id' => 'TMY2003',
                'name' => '谭明宇',
                'phone' => '13015190822',
                'email' => 'tmy@qq.com',
                'performance' => 100,
                'status' => 'off',
                'created_at' => '2017-05-23 01:56:53',
                'updated_at' => '2017-05-23 02:04:43',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}