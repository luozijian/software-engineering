<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class PerformancePermissionCriteria
 * @package namespace App\Criteria;
 */
class PerformancePermissionCriteria implements CriteriaInterface
{
    /**
     * Apply criteria in query repository
     *
     * @param                     $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $user=\Auth::user();
        //游客只能查看公开资源
        if(!$user){
            return $model->where('permission','null');
        }

        $role=$user->roles->get(0)->name;

        //管理员和学生和老师看到全部资源
        if($user->isAdmin()||$role=="student"||$role=="teacher"){
            return $model;
        }

        //社区看到公共和社区资源
        if($role=="community"){
            return $model->whereIn('permission',['public','community']);
        }

        //社区看到公共和社区资源
        if($role=="ordinary"){
            return $model->where('permission','public');
        }

        //其他角色看不到
        return $model->where('permission','null');
    }
}
