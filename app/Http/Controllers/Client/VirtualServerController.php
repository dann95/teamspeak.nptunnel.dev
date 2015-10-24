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
                    'ip'        =>  $host.":".$port,
                ],
            ],

        ];
        if($server['virtualserver_status'] == "online")
        {
            $configs_online = ['server' => [
                'password'  =>  [
                    'flag'  =>  $server["virtualserver_flag_password"],
                    'pwd'   =>  $server['virtualserver_password'],
                ],
                'status' => [
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
            ]];

            $configs = array_merge_recursive($configs,$configs_online);
        }

        return view('Client.VirtualServer.settings' , compact('configs','virtualServer'));

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

    public function powerOn($id)
    {
        $virtualServer = $this->getVirtualServer($id);
        $sid = $virtualServer->v_sid;
        $credentials = $virtualServer->server()->credentials;
        $manager = new Manager($credentials);
        $manager->startServerBySid($sid);
        return redirect()->route('account.virtual.settings',['id' => $virtualServer->id]);
    }

    public function powerOff($id)
    {
        $virtualServer = $this->getVirtualServer($id);
        $sid = $virtualServer->v_sid;
        $credentials = $virtualServer->server()->credentials;
        $manager = new Manager($credentials);
        $server = $manager->selectServer($sid);
        $server->stop();
        return redirect()->route('account.virtual.settings',['id' => $virtualServer->id]);
    }

    public function password(Request $request)
    {
        dd($request->all());
    }
}
