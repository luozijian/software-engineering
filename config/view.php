<?php

return [

    /*
    |--------------------------------------------------------------------------
    | View Storage Paths
    |--------------------------------------------------------------------------
    |
    | Most templating systems load templates from disk. Here you may specify
    | an array of paths that should be checked for your views. Of course
    | the usual Laravel view path has already been registered for you.
    |
    */

    'paths' => [
        realpath(base_path('resources/views')),
    ],

    /*
    |--------------------------------------------------------------------------
    | Compiled View Path
    |--------------------------------------------------------------------------
    |
    | This option determines where all the compiled Blade templates will be
    | stored for your application. Typically, this is within the storage
    | directory. However, as usual, you are free to change this value.
    |
    */

    'compiled' => realpath(storage_path('framework/views')),

    'data' => [
        'has_basic_salary' => [
            null => '请选择',
            0 => '无底薪',
            1 => '有底薪',
        ],
        'client_gender' => [
            null => '请选择',
            0 => '女',
            1 => '男',
        ],
        'commission_release_by' => [
            null => '请选择',
            0 => '现金',
            1 => '香港支票',
            2 => '转账',
        ],
        'can_develop_team' => [
            null => '请选择',
            0 => '不能',
            1 => '能',
        ],
        'policy_status' => [
            null => '请选择',
            1 => '已成功批核',
            2 => '客户已经签署确认收妥',
            3 => '投保申请有事项需待跟进',
            4 => '投保申请需跟进事项已更新',
        ],
        'genders' => [
            0 => '女',
            1 => '男',
        ],
        'product_types' => [
            'A' => 'A类',
            'B' => 'B类',
        ],
        'currencies' => [
            0 => '港币',
            1 => '美元',
        ],
        'product_status' => [
            'on' => '开启',
            'off' => '关闭',
        ],
        'performance_type' => [
            'personal' => '个人',
            'team' => '团队',
        ],
    ]

];
