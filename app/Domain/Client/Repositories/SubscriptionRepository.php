<?php

namespace   NpTS\Domain\Client\Repositories;

use NpTS\Abstracts\Repository\Repository;
use NpTS\Domain\Client\Models\Subscription;
use NpTS\Domain\Client\Repositories\Contracts\SubscriptionRepositoryContract;

class SubscriptionRepository extends Repository implements SubscriptionRepositoryContract
{
    protected $model;
    public function __construct(Subscription $model)
    {
        $this->model = $model;
    }

    public function findActiveSubscriptionsByUserId($uid)
    {
        return $this->model->where([
            'active' => 1,
            'user_id' => $uid
        ])->get();
    }
}


