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
                'work_id' => 'FZ001',
                'name' => '张捧捧',
                'phone' => '15889715182',
                'email' => 'floris@linkerlab.net',
                'performance' => '',
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
                'work_id' => 'IH01',
                'name' => '何欧文',
                'phone' => '15889715181',
                'email' => 'IrvingHe@linkerlab.net',
                'performance' => '',
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
                'work_id' => 'WP01',
                'name' => '潘微科',
                'phone' => '13015190822',
                'email' => 'pwk@szu.edu.cn',
                'performance' => '',
                'status' => 'off',
                'created_at' => '2017-05-23 01:56:53',
                'updated_at' => '2017-05-23 02:04:43',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}