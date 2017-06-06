<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \Ricoa\Auth\Models\User::create([
            'email'=>"2@qq.com",
            'name'=>'员工',
            'password'=>'1',
            'remember_token' => str_random(10),
        ]);
        $user->beRole("employee");

        $user = \Ricoa\Auth\Models\User::create([
            'email'=>"3@qq.com",
            'name'=>'员工',
            'password'=>'1',
            'remember_token' => str_random(10),
        ]);
        $user->beRole("employee");

        $user = \Ricoa\Auth\Models\User::create([
            'email'=>"4@qq.com",
            'name'=>'员工',
            'password'=>'1',
            'remember_token' => str_random(10),
        ]);
        $user->beRole("employee");

        $user = \Ricoa\Auth\Models\User::create([
            'email'=>"5@qq.com",
            'name'=>'员工',
            'password'=>'1',
            'remember_token' => str_random(10),
        ]);
        $user->beRole("employee");

        $user = \Ricoa\Auth\Models\User::create([
            'email'=>"6@qq.com",
            'name'=>'员工',
            'password'=>'1',
            'remember_token' => str_random(10),
        ]);
        $user->beRole("employee");

        $user = \Ricoa\Auth\Models\User::create([
            'email'=>"7@qq.com",
            'name'=>'员工',
            'password'=>'1',
            'remember_token' => str_random(10),
        ]);
        $user->beRole("employee");

        $user = \Ricoa\Auth\Models\User::create([
            'email'=>"8@qq.com",
            'name'=>'员工',
            'password'=>'1',
            'remember_token' => str_random(10),
        ]);
        $user->beRole("employee");

        $user = \Ricoa\Auth\Models\User::create([
            'email'=>"9@qq.com",
            'name'=>'员工',
            'password'=>'1',
            'remember_token' => str_random(10),
        ]);
        $user->beRole("employee");


        $user = \Ricoa\Auth\Models\User::create([
            'email'=>"15@qq.com",
            'name'=>'系统管理员',
            'password'=>'1',
            'remember_token' => str_random(10),
        ]);
        $user->beRole("admin");

    }
}
