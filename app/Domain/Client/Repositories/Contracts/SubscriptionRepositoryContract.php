<?php

namespace NpTS\Domain\Client\Repositories\Contracts;


interface SubscriptionRepositoryContract
{
    public function findActiveSubscriptionsByUserId($uid);
}