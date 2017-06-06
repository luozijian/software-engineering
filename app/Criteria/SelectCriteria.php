<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class SelectCriteria
 * @package namespace App\Criteria;
 */
class SelectCriteria implements CriteriaInterface
{
    /**
     * @var
     */
    private $fields;

    function __construct($fields)
    {
        $this->fields = $fields;
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
        return $model->select($this->fields);
    }
}
