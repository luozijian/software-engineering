<?php

return [

    /**
     * blade to show menus
     */
    'blade'=>'layouts.menu',

    /**
     * all menus
     */
    'menus'=>[
        [
            'title'=>'首页',
            'action'=>'AdminController@index',
            'active'=>'admin'
        ],
        [
            'title'=>'权限管理',
            'sub'=>[
                [
                    'title'=>'所有权限',
                    'action'=>'\Ricoa\Auth\Controllers\PermissionController@index'
                ],
                [
                    'title'=>'系统角色',
                    'action'=>'\Ricoa\Auth\Controllers\RoleController@index'
                ],
                [
                    'title'=>'用户角色',
                    'action'=>'\Ricoa\Auth\Controllers\RoleUserController@index'
                ],

            ],
            'active'=>'admin/auth*'
        ],
        [
            'title'=>'员工管理',
            'sub'=>[
                [
                    'title'=>'员工信息',
                    'action'=>'EmployeeController@index'
                ],
                [
                    'title'=>'后台帐号',
                    'action'=>'UserController@index'
                ],
            ],
            'active'=>'admin/employees*'
        ],
        [
            'title'=>'职级管理',
            'sub' => [
                [
                    'title'=>'职级信息',
                    'action'=>'RankController@index'
                ],
            ],
            'active'=>'admin/employees/ranks*'
        ],
        [
            'title'=>'产品管理',
            'sub'=>[
                [
                    'title'=>'产品信息',
                    'action'=>'ProductController@index',
                ],

            ],
            'active'=>'admin/products*'
        ],
        [
            'title'=>'单据管理',
            'sub'=>[
                [
                    'title'=>'单据信息',
                    'action'=>'PolicyController@index'
                ],

            ],
            'active'=>'admin/policies*'
        ],
        [
            'title'=>'业绩管理',
            'sub'=>[
                [
                    'title'=>'员工业绩',
                    'action'=>'PerformanceController@indexByEmployee',
                ],
            ],
            'active'=>'admin/performances*'
        ],
    ],

    /**
     * role who can see all menus
     */
    'super'=>'super',

    /**
     * route attributes
     */
    'routeAttributes'=>[
        'prefix'=>'admin/auth',
        'middleware'=>[
            'web',
            'auth',
            'route-permission'
        ]
    ],

    /**
     *  don't validate auth in those action
     */
    'validateExcept'=>[
        'AdminController@index',
        'AdminController@bossName',
        'AdminController@signerName',
        'RankController@index',
        'ProductController@index',
        'PerformanceController@indexByEmployee',
        'PerformanceController@index',
        'PolicyController@index',
        'UserController@index',
    ],

    'agent'=>\Ricoa\Auth\Agent\DefaultMenusAgent::class,

];