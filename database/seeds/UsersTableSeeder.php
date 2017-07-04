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
                'remember_token' => 'a2bufrFPDLfjoOvjGtQgGfctwIuiTLQ5jZSUpR7rnRcNf9FvrVjZJe90ZK5o',
                'created_at' => '2017-05-18 14:32:21',
                'updated_at' => '2017-07-04 17:28:35',
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
            3 => 
            array (
                'id' => 4,
                'email' => '11111',
                'password' => '$2y$10$9U94XUfFr2zptJCa4NIohOitQiJ500N18jsy7GSNNJuC3UXaNNYtu',
                'name' => 'test1',
                'remember_token' => 'TjIO2w12MsIB7eRCxyp8Bo0P5MIc9h8lb0LrbTXlFNKzWvFd2az8xv3XWrsN',
                'created_at' => '2017-07-04 17:22:30',
                'updated_at' => '2017-07-04 21:13:16',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}