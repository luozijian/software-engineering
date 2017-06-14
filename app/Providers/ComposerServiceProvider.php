<?php

namespace App\Providers;

use App\Models\Channel;
use App\Models\ChannelRank;
use App\Models\Employee;
use App\Models\Policy;
use App\Models\Product;
use App\Models\Role;
use App\Models\Rank;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * 在容器內註冊所有綁定。
     *
     * @return void
     */
    public function boot()
    {
       
    }

    /**
     * 註冊服務提供者。
     *
     * @return void
     */
    public function register()
    {
        view()->composer(['employees.fields'],function ($view) {
            $has_basic_salary = config("view.data.has_basic_salary");
            $ranks = [null=>'请选择'] + Rank::pluck('name','id')->toArray();
            $view->with(compact('has_basic_salary','ranks'));
        });

        view()->composer(['users.fields','employees.fields'],function ($view) {
            $roles = [null=>"请选择"]+ Role::pluck('display_name','id')->toArray();
            $view->with("roles",$roles);
        });

        view()->composer(['policies.fields'],function ($view) {
            $client_gender = config("view.data.client_gender");
            $products = [null=>'请选择'] + Product::where('status','on')->pluck('name','id')->toArray();
            $employees = Employee::pluck('work_id','id')->toArray();
            $view->with(compact('client_gender','products','employees'));
        });
    }
}