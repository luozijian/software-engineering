<?php

namespace App\Criteria;

use App\Models\Channel;
use App\Models\Employee;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class MyPerformanceCriteria
 * @package namespace App\Criteria;
 */
class MyPerformanceCriteria implements CriteriaInterface
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
                $performanceable_id = isset($user->employee) ? $user->employee->id : 0;
                $performanceable_type = 'App\Models\Employee';
                $subordinate_ids = Employee::where('boss_id',$performanceable_id)->get()->pluck('id');
            }elseif ($user->isChannel()){
                $performanceable_id = isset($user->channel) ? $user->channel->id : 0;
                $performanceable_type = 'App\Models\Channel';
                $subordinate_ids = Channel::where('boss_id',$performanceable_id)->get()->pluck('id');
            }else{
                return redirect(403);
            }
            $model = $model->where(compact('performanceable_id'))->orWhereIn('performanceable_id',$subordinate_ids)->where(compact('performanceable_type'));
        }
        return $model;
    }
}
