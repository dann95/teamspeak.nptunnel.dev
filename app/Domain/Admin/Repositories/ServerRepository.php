<?php

namespace NpTS\Domain\Admin\Repositories;

use NpTS\Domain\Admin\Models\Server;
use NpTS\Domain\Admin\Repositories\Contracts\ServerRepositoryContract;
use NpTS\Abstracts\Repository\Repository;

class ServerRepository extends Repository implements ServerRepositoryContract
{
    /**
     * @var Server
     */
    protected $model;

    /**
     * @param Server $model
     */
    public function __construct(Server $model)
    {
        $this->model = $model;
    }

    public function add(array $options)
    {
        return $this->model->create($options);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function actives()
    {
        return $this->model->where('active',1)->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function activesForSale()
    {
        return $this->model->where('active_sales',1)->get();
    }

    /**
     * @param $forSlots
     * @return \NpTS\Domain\Admin\Models\Server
     */
    public function randomEmptyServer($forSlots)
    {
        return $this->activesForSale()
            ->filter(function($item) use($forSlots){
            return $item->freeSlots > $forSlots;
        })->random();
    }
}