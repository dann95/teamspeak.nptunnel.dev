<?php

namespace NpTS\Http\Controllers\Client;

use Illuminate\Http\Request;
use NpTS\Http\Requests;
use NpTS\Http\Controllers\Controller;
use NpTS\Domain\Client\Repositories\Contracts\VirtualServerRepositoryContract;

class VirtualServerController extends Controller
{
    private $repository;
    public function __construct(VirtualServerRepositoryContract $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }

    public function settings($id)
    {
        return view('Client.VirtualServer.settings');
    }
    public function privilegeKeys($id)
    {

    }
    public function banList($id)
    {

    }
    public function tsBot($id)
    {

    }

    private function getVirtualServer($id)
    {
        $virtualServer = $this->repository->find($id);

        if($virtualServer)
            return $virtualServer;

        return false;
    }
}
