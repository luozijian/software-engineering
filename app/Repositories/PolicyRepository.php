<?php

namespace App\Repositories;

use App\Models\Policy;
use InfyOm\Generator\Common\BaseRepository;

class PolicyRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'employee_id',
        'client_name',
        'client_gender',
        'client_phone',
        'client_email',
        'repay_year',
        'repay_amount',
        'handle_company',
        'handle_signer',
        'paid_at',
        'product.supplier',
        'product.plan',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Policy::class;
    }

}
