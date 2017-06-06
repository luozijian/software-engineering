<?php

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //员工
        $employee = new Role();
        $employee->name         = 'employee';
        $employee->display_name = '员工'; // optional
        $employee->description  = '员工'; // optional
        $employee->save();

        //管理员
        $admin = new Role();
        $admin->name         = 'admin';
        $admin->display_name = '管理员'; // optional
        $admin->description  = '系统管理员'; // optional
        $admin->save();

        $permission = new Permission();
        $permission->name         = 'EmployeeController@index';
        $permission->display_name = '【1】员工列表'; // optional
        $permission->description  = '【5】员工'; // optional
        $permission->save();
        $employee->attachPermission($permission);
        $admin->attachPermission($permission);

        $permission = new Permission();
        $permission->name         = 'EmployeeController@create-store';
        $permission->display_name = '【2】员工创建'; // optional
        $permission->description  = '【5】员工'; // optional
        $permission->save();
        $admin->attachPermission($permission);

        $permission = new Permission();
        $permission->name         = 'EmployeeController@edit-update';
        $permission->display_name = '【3】员工编辑'; // optional
        $permission->description  = '【5】员工'; // optional
        $permission->save();
        $admin->attachPermission($permission);
        $employee->attachPermission($permission);

        $permission = new Permission();
        $permission->name         = 'EmployeeController@destroy';
        $permission->display_name = '【4】员工离职'; // optional
        $permission->description  = '【5】员工'; // optional
        $permission->save();
        $admin->attachPermission($permission);

        //产品管理
        $permission = new Permission();
        $permission->name         = 'ProductController@create-store';
        $permission->display_name = '【1】产品创建'; // optional
        $permission->description  = '【6】产品'; // optional
        $permission->save();
        $admin->attachPermission($permission);



        $permission = new Permission();
        $permission->name         = 'ProductController@show';
        $permission->display_name = '【4】产品详情'; // optional
        $permission->description  = '【6】产品'; // optional
        $permission->save();
        $admin->attachPermission($permission);

        $permission = new Permission();
        $permission->name         = 'ProductController@destroy';
        $permission->display_name = '【5】产品关闭'; // optional
        $permission->description  = '【6】产品'; // optional
        $permission->save();
        $admin->attachPermission($permission);

        $permission = new Permission();
        $permission->description  = '【7】产品'; // optional
        $permission->save();
        $admin->attachPermission($permission);



        //订单管理
        $permission = new Permission();
        $permission->name         = 'PolicyController@create-store';
        $permission->display_name = '【1】单据创建'; // optional
        $permission->description  = '【8】单据'; // optional
        $permission->save();
        $admin->attachPermission($permission);


        $permission = new Permission();
        $permission->name         = 'PolicyController@destroy';
        $permission->display_name = '【5】单据删除'; // optional
        $permission->description  = '【8】单据'; // optional
        $permission->save();
        $admin->attachPermission($permission);

        $permission = new Permission();
        $permission->name         = 'PolicyController@show';
        $permission->display_name = '【6】单据详情'; // optional
        $permission->description  = '【8】单据'; // optional
        $permission->save();
        $admin->attachPermission($permission);
        $employee->attachPermission($permission);



    }
}
