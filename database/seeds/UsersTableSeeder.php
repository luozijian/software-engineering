<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'email' => '1@qq.com',
                'password' => '$2y$10$/DxUsps5AqZcFq9bz4hsjuweh7dy7PjwErT8oR2RlWPIK7wsFLdRm',
                'name' => '超级管理员',
                'remember_token' => '77t6p6CjY0',
                'created_at' => '2017-05-18 14:32:21',
                'updated_at' => '2017-05-18 14:32:21',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'email' => 'ZZP2002',
                'password' => '$2y$10$02z/ij9ZhNyK17r9ywtTnuB.DeRP76OeGi9NiYwSQqRgDb8lF/HvG',
                'name' => '曾志平',
                'remember_token' => NULL,
                'created_at' => '2017-05-22 06:56:37',
                'updated_at' => '2017-05-22 06:56:37',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'email' => 'TMY2003',
                'password' => '$2y$10$IqFrKG.AoR.tx4DGKQ4D.uIGF.zVPfMM4OTTfUK8E1139/rfqmuQO',
                'name' => '谭明宇',
                'remember_token' => NULL,
                'created_at' => '2017-05-22 06:57:55',
                'updated_at' => '2017-05-22 06:57:55',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}