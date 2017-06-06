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
            $products_of_A = Product::where('type','A')->where('status','on')->pluck('name','id');
            $products_of_B = Product::where('type','B')->where('status','on')->pluck('name','id');
            $product_data = Product::select('id','name','plan','supplier','rate')->get();
            $currencies = [null=>"请选择"] + config('view.data.currencies');
            $employees = Employee::pluck('work_id','id')->toArray();
            $channels = Channel::pluck('work_id','id')->toArray();
            $signers = [null=>"请选择"] + array_merge($employees,$channels);
            $view->with(compact('client_gender','products_of_A','products_of_B','product_data','currencies','signers'));
        });

        view()->composer(['policies.release'],function ($view) {
            $commission_release_by = config("view.data.commission_release_by");
            $view->with("commission_release_by",$commission_release_by);
        });

        view()->composer(['policies.review','policies.transfer'],function ($view) {
            $policies = [null => '请选择'] + Policy::pluck('policy_number', 'id')->toArray();
            $policy_status = [null => '请选择'] + config('view.data.policy_status');
            $view->with(compact('policies', 'policy_status'));
        });

         view()->composer(['policies.search_fields'],function ($view) {
             $genders = [null => '请选择'] + config("view.data.genders");
             $product_types = [null => '请选择'] + config("view.data.product_types");
             $view->with(compact('genders','product_types'));
         });

        view()->composer(['products.search_fields'],function ($view) {
            $product_status =  config("view.data.product_status");
            $view->with(compact('product_status'));
        });

        view()->composer(['performances.search_fields'],function ($view) {
            $performance_type = [null => '请选择'] + config("view.data.performance_type");
            $view->with(compact('performance_type'));
        });
    }
}