<?php

namespace App\Criteria;

use App\Models\Channel;
use App\Models\Employee;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class MyPolicyCriteria
 * @package namespace App\Criteria;
 */
class MyPolicyCriteria implements CriteriaInterface
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
            if ($user->isEmployee()){
                $employee_id = isset($user->employee) ? $user->employee->id : 0;
                $subordinate_ids = Employee::where('boss_id',$employee_id)->get()->pluck('id');
            }else{
                return redirect(403);
            }
            $model = $model->where(compact('employee_id'))->orWhereIn('employee_id',$subordinate_ids);
        }
        return $model;
    }
}
