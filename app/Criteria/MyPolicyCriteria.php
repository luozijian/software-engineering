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
                $policieable_id = isset($user->employee) ? $user->employee->id : 0;
                $policieable_type = 'App\Models\Employee';
                $subordinate_ids = Employee::where('boss_id',$policieable_id)->get()->pluck('id');
            }elseif ($user->isChannel()){
                $policieable_id = isset($user->channel) ? $user->channel->id : 0;
                $policieable_type = 'App\Models\Channel';
                $subordinate_ids = Channel::where('boss_id',$policieable_id)->get()->pluck('id');
            }else{
                return redirect(403);
            }
            $model = $model->where(compact('policieable_id'))->orWhereIn('policieable_id',$subordinate_ids)->where(compact('policieable_type'));
        }
        return $model;
    }
}
