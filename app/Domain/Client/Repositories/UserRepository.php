<?php


namespace NpTS\Domain\Client\Repositories;

use NpTS\Abstracts\Repository\Repository;
use NpTS\Domain\Client\Models\User;
use NpTS\Domain\Client\Repositories\Contracts\UserRepositoryContract;
use NpTS\Domain\Client\Events\UserWasCreated;

class UserRepository extends Repository implements UserRepositoryContract
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function customers()
    {
        return $this->model->where('is_admin',0)->get();
    }

    public function create(array $options)
    {
        $options['password'] = bcrypt($options['password']);
        $user = $this->model->create($options);
        event(new UserWasCreated($user));
        return $user;
    }

    public function activateByKey($key)
    {
        $user = $this->model->where('activation_key',$key)->get()->first();
        if(! $user or $user->active)
        {
            return false;
        }
        $user->active = 1;
        $user->save();
        return $user;
    }
}