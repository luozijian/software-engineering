<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class WhereCriteria
 * @package namespace App\Criteria;
 */
class WhereCriteria implements CriteriaInterface
{
    /**
     * @var
     */
    private $field;
    /**
     * @var
     */
    private $operation;
    /**
     * @var
     */
    private $value;

    function __construct($field,$operation,$value)
    {

        $this->field = $field;
        $this->operation = $operation;
        $this->value = $value;
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
        return $model->where($this->field,$this->operation,$this->value);
    }
}
