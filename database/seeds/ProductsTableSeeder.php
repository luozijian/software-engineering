<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('products')->delete();
        
        \DB::table('products')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => '碧桂园洗面奶',
                'price' => 100,
                'status' => 'off',
                'created_at' => '2017-05-18 14:32:22',
                'updated_at' => '2017-05-22 07:04:54',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => '小米3',
                'price' => 100,
                'status' => 'off',
                'created_at' => '2017-05-18 14:32:22',
                'updated_at' => '2017-05-22 07:04:51',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'iphone8',
                'price' => 100,
                'status' => 'off',
                'created_at' => '2017-05-18 14:32:22',
                'updated_at' => '2017-05-22 07:18:17',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => '万科',
                'price' => 100,
                'status' => 'off',
                'created_at' => '2017-05-18 14:32:22',
                'updated_at' => '2017-05-22 07:18:09',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => '仁恒',
                'price' => 100,
                'status' => 'off',
                'created_at' => '2017-05-18 14:32:22',
                'updated_at' => '2017-05-22 07:18:05',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => '锤子手机',
                'price' => 100,
                'status' => 'off',
                'created_at' => '2017-05-22 07:12:19',
                'updated_at' => '2017-05-22 09:43:51',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => '婴儿奶粉',
                'price' => 100,
                'status' => 'on',
                'created_at' => '2017-05-22 07:23:27',
                'updated_at' => '2017-05-22 07:23:27',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'i watch',
                'price' => 100,
                'status' => 'on',
                'created_at' => '2017-05-23 01:03:55',
                'updated_at' => '2017-05-23 01:03:55',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}