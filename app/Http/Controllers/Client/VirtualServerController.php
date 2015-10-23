<?php

namespace NpTS\Http\Controllers\Client;

use Illuminate\Http\Request;
use NpTS\Http\Requests;
use NpTS\Http\Controllers\Controller;
use NpTS\Domain\Client\Repositories\Contracts\VirtualServerRepositoryContract;
use Illuminate\Auth\Guard;
use NpTS\Domain\TeamSpeak\Manager;

class VirtualServerController extends Controller
{
    private $repository;
    private $auth;
    public function __construct(VirtualServerRepositoryContract $repository , Guard $auth)
    {
        parent::__construct();
        $this->repository = $repository;
        $this->auth = $auth;
    }

    public function settings($id)
    {
        $virtualServer = $this->getVirtualServer($id);
        $sid = $virtualServer->v_sid;
        $host = $virtualServer->server()->dns;
        $port = $virtualServer->port;
        $credentials = $virtualServer->server()->credentials;
        $manager = new Manager($credentials);
        $server = $manager->selectServer($sid);

        $configs = [
            'server'    =>[
                'name'  =>  $server["virtualserver_name"],
                'status'    =>  [
                    'state' =>  $server["virtualserver_status"],
                    'slots' =>  $server['virtualserver_clientsonline']-$server['virtualserver_queryclientsonline']. "/" .$server['virtualserver_maxclients'],
                    'uptime'    =>  $server['virtualserver_uptime'],
                ],
                'descriptions'  =>  [
                    'plataform' =>  $server['virtualserver_platform'],
                    'created'   =>  $server['virtualserver_created'],
                    'version'   =>  $server['virtualserver_version'],
                    'welcome'   =>  $server['virtualserver_welcomemessage'],
                    'minClientVersion'  =>  $server['virtualserver_min_client_version'],
                    'hostBanner'  =>  $server['virtualserver_hostbanner_url'],
                    'hostBannerGfx' =>  $server['virtualserver_hostbanner_gfx_url'],
                ]
            ],

        ];

        return view('Client.VirtualServer.settings' , compact('configs'));

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

        if($virtualServer && $virtualServer->user_id == $this->auth->user()->id)
            return $virtualServer;
        abort(403);
    }
}
