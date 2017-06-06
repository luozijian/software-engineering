<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class MyEmployeeCriteria
 * @package namespace App\Criteria;
 */
class MyEmployeeCriteria implements CriteriaInterface
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
        $user = \Auth::user();
        if(!$user->isSuper() && !$user->isAdmin()){
            $employee_id = isset($user->employee) ? $user->employee->id : 0;
            $model=$model->where('id',$employee_id)->orWhere('boss_id',$employee_id);
        }
        return $model;
    }
}
