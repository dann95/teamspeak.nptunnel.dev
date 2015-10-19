<?php

namespace NpTS\Domain\Admin\Repositories;

use NpTS\Domain\Admin\Models\Server;
use NpTS\Domain\Admin\Repositories\Contracts\ServerRepositoryContract;

class ServerRepository implements ServerRepositoryContract
{
    /**
     * @var Server
     */
    private $model;

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
    public function all()
    {
        return $this->model->all();
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
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        $id = (int) $id;
        return $this->model->find($id);
    }

    /**
     * @param $id
     * @param array $options
     * @return bool
     */
    public function update($id , array $options)
    {
        $id = (int) $id;

        $model = $this->find($id);

        if($model)
            return $model->update($options);

        return false;

    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $id = (int) $id;

        $model = $this->find($id);

        if($model)
            return $model->delete();

        return false;
    }


}