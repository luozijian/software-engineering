<?php

namespace App\Repositories;

use App\Models\Employee;
use InfyOm\Generator\Common\BaseRepository;

class EmployeeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'boss_id',
        'boss_work_id',
        'boss_name',
        'work_id',
        'name',
        'english_name',
        'job',
        'job_point',
        'phone',
        'email',
        'address',
        'entered_at',
        'professional_qualification',
        'account'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Employee::class;
    }
}
