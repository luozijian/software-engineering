<?php

namespace App\Repositories;

use App\Models\Performance;
use InfyOm\Generator\Common\BaseRepository;

class PerformanceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'product_id',
        'employee_id',
        'repay_amount',
        'repay_year',
        'repay_amount_year',
        'job_point',
        'job_point_diff',
        'deal_amount',
        'product_rate',
        'BV_point_sum',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Performance::class;
    }
}
