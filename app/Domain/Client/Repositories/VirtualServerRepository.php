<?php

namespace NpTS\Domain\Client\Repositories;

use NpTS\Abstracts\Repository\Repository;
use NpTS\Domain\Client\Models\User;
use NpTS\Domain\Client\Repositories\Contracts\VirtualServerRepositoryContract;
use NpTS\Domain\Client\Models\VirtualServer;
use NpTS\Domain\Admin\Repositories\Contracts\ServerRepositoryContract;
use Illuminate\Auth\Guard;
use NpTS\Abstracts\TeamSpeak\DefaultVirtualServerValues;
use NpTS\Domain\TeamSpeak\Manager;

class VirtualServerRepository extends Repository implements VirtualServerRepositoryContract
{
    protected $model;
    private $guard;
    private $serverRepository;
    public function __construct(VirtualServer $virtualServer , Guard $guard , ServerRepositoryContract $serverRepository)
    {
        $this->model = $virtualServer;
        $this->guard = $guard;
        $this->serverRepository = $serverRepository;
    }

    /**
     * @param array $options
     */
    public function create(array $options)
    {
        return $this->createVirtualServer($options);
    }

    private function createVirtualServer(array $options)
    {
        // select an server empty server to create the virtual server..
        $server = $this->serverRepository->randomEmptyServer($options['slots']);

        // instance the Manager class passing the credentials of the selected server:
        $manager = new Manager($server->credentials);

        // create the virtual server with the default and custom values.
        $virtualServer = $manager->createServer($this->mergeOptionsOfVirtualServer($options));

        /**
         * @todo all you can read ! XD \/
         */
        // we must relate the virtual server to a server, the virtual server to an user on the database!
        // and also, the virtual server to an plan!

    }

    /**
     * Mix the defaults values of new virtual server, as well the number of slots.
     * @param array $options
     * @return array
     */
    private function mergeOptionsOfVirtualServer(array $options)
    {
        $serverOptions = [
            "virtualserver_maxclients"  =>  $options['slots'],
        ];
        $default = new DefaultVirtualServerValues();
        return $serverOptions + $default->preferences();
    }
}