<?php

namespace NpTS\Abstracts\Repository;

abstract class Repository
{
    public function all()
    {
        return $this->model->all();
    }

    public function create(array $options)
    {
        return $this->model
            ->create($options);
    }

    public function find($id)
    {
        $id = (int) $id;
        return $this->model->find($id);
    }

    public function update($id , array $options)
    {
        $id = (int) $id;

        $entity = $this->model->find($id);

        if($entity)
            return $entity->update($options);

        return false;
    }

    public function delete($id)
    {
        $id = (int) $id;
        $entity = $this->find($id);

        if($entity)
            return $entity->delete();

        return false;

    }

}