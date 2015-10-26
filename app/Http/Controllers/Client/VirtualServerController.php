<?php

namespace NpTS\Http\Controllers\Client;

use Illuminate\Http\Request;
use NpTS\Http\Requests;
use NpTS\Http\Controllers\Controller;
use NpTS\Domain\Client\Repositories\Contracts\VirtualServerRepositoryContract;
use Illuminate\Auth\Guard;
use NpTS\Domain\TeamSpeak\Manager;

use NpTS\Domain\Client\Requests\ChangeVirtualServerPasswordRequest;
use NpTS\Domain\Client\Requests\ChangeVirtualServerMessagesRequest;
use NpTS\Domain\Client\Requests\ChangeVirtualServerBannerRequest;
use NpTS\Domain\Client\Models\VirtualServer;

class VirtualServerController extends Controller
{
    /**
     * @var VirtualServerRepositoryContract
     */
    private $repository;

    /**
     * @var Guard
     */
    private $auth;

    /**
     * @param VirtualServerRepositoryContract $repository
     * @param Guard $auth
     */
    public function __construct(VirtualServerRepositoryContract $repository , Guard $auth)
    {
        parent::__construct();
        $this->repository = $repository;
        $this->auth = $auth;
    }

    /**
     * Display the forms to change settings..
     * @param $id
     * @return \Illuminate\View\View
     */
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
                    'name'      =>  $server['virtualserver_name'],
                    'hostMsg'   =>  $server['virtualserver_hostmessage'],
                    'hostMsgMode'   =>  $server['virtualserver_hostmessage_mode'],
                    'plataform' =>  $server['virtualserver_platform'],
                    'created'   =>  $server['virtualserver_created'],
                    'version'   =>  $server['virtualserver_version'],
                    'welcome'   =>  $server['virtualserver_welcomemessage'],
                    'minClientVersion'  =>  $server['virtualserver_min_client_version'],
                    'hostBanner'  =>  $server['virtualserver_hostbanner_url'],
                    'hostBannerGfx' =>  $server['virtualserver_hostbanner_gfx_url'],
                    'hostBannerTime'    =>  $server['virtualserver_hostbanner_gfx_interval'],
                    'hostBannerResize'  =>  $server['virtualserver_hostbanner_mode'],
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

    /**
     * Get the entity of a server by your id.
     * @param $id
     * @return \NpTS\Domain\Client\Models\VirtualServer
     */
    private function getVirtualServer($id)
    {
        $virtualServer = $this->repository->find($id);

        if($virtualServer && $virtualServer->user_id == $this->auth->user()->id)
            return $virtualServer;
        abort(403);
    }

    /**
     * Start an Server
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function powerOn($id)
    {
        $this->serverManager($id)
            ->start();
        return redirect()->route('account.virtual.settings',['id' => $id]);
    }

    /**
     * PowerOff an VirtualServer
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function powerOff($id)
    {
        $this->serverManager($id)
            ->stop();
        return redirect()->route('account.virtual.settings',['id' => $id]);
    }

    /**
     * Change Password of a VirtualServer
     * @param $id
     * @param ChangeVirtualServerPasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password($id , ChangeVirtualServerPasswordRequest $request)
    {
        $this->serverManager($id)
            ->modify(
                ['virtualserver_password' => $request->only(['password'])['password'] ]
            );
        return redirect()->route('account.virtual.settings',['id'=> $id]);
    }

    /**
     * Change host message , welcome message.. and others..
     * @param $id
     * @param ChangeVirtualServerMessagesRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function messages($id , ChangeVirtualServerMessagesRequest $request)
    {
        $this->serverManager($id)
            ->modify(
                $request->only([
                    "virtualserver_name",
                    "virtualserver_welcomemessage",
                    "virtualserver_hostmessage",
                    "virtualserver_hostmessage_mode",
                ])
            );
        return redirect()->route('account.virtual.settings',['id'=> $id]);
    }

    /**
     * Change the banner information of an VitualServer
     * @param $id
     * @param ChangeVirtualServerBannerRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function banner($id , ChangeVirtualServerBannerRequest $request)
    {
        $this->serverManager($id)
            ->modify(
                $request->only([
                    "virtualserver_hostbanner_url",
                    "virtualserver_hostbanner_gfx_url",
                    "virtualserver_hostbanner_gfx_interval",
                    "virtualserver_hostbanner_mode",
                ])
            );
        return redirect()->route('account.virtual.settings',['id'=> $id]);
    }

    /**
     * Select Virtual Server by the credentials saved on database.
     * @param $id
     * @return \TeamSpeak3\Node\Server
     */
    private function serverManager($id)
    {
        $virtualServer = $this->getVirtualServer($id);
        return (new Manager($virtualServer->server()->credentials))->selectServer($virtualServer->v_sid);
    }
}
