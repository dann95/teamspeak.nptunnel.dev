<?php

namespace NpTS\Domain\Admin\Repositories\Contracts;

interface PlanRepositoryContract
{
    public function all();
    public function create(array $options);
    public function find($id);
    public function delete($id);
    public function actives();
    public function findActiveById($id);
}