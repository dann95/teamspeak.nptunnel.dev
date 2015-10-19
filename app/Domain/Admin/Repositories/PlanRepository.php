<?php


namespace NpTS\Domain\Admin\Repositories;

use NpTS\Domain\Admin\Repositories\Contracts\PlanRepositoryContract;
use NpTS\Domain\Admin\Models\Plan;

use NpTS\Abstracts\Repository\Repository;

class PlanRepository extends Repository implements PlanRepositoryContract
{
    protected $model;
    public function __construct(Plan $model)
    {
        $this->model = $model;
    }
}