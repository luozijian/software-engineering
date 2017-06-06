<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class OrderByCriteria
 * @package namespace App\Criteria;
 */
class OrderByCriteria implements CriteriaInterface
{
    /**
     * @var
     */
    private $field;

    /**
     * @var
     */
    private $order;


    public function __construct($field,$order='desc')
    {

        $this->field = $field;
        $this->order = $order;
    }
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
        return $model->orderBy($this->field,$this->order);
    }
}
