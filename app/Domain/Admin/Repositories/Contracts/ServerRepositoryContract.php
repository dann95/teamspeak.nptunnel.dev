<?php

namespace NpTS\Domain\Admin\Repositories\Contracts;

interface ServerRepositoryContract
{
    public function add(array $options);

    public function all();

    public function actives();

    public function activesForSale();

    public function find($id);

    public function update($id , array $options);

    public function delete($id);

    public function randomEmptyServer($forSlots);
}