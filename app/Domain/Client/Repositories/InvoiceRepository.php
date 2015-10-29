<?php

namespace NpTS\Domain\Client\Repositories;

use NpTS\Abstracts\Repository\Repository;
use NpTS\Domain\Client\Repositories\Contracts\InvoiceRepositoryContract;
use NpTS\Domain\Client\Models\Invoice;


class InvoiceRepository extends Repository implements InvoiceRepositoryContract
{
    protected $model;

    public function __construct(Invoice $model)
    {
        $this->model = $model;
    }
}