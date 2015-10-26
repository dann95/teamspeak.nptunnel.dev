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
        $configs = $this->getVirtualServerSettings($id);
        $virtualServer = $this->getVirtualServer($id);
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
                $request->only(['virtualserver_password'])
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

    /**
     * Settings of an VirtualServer for the @settings
     * @param $id
     * @return array
     */
    private function getVirtualServerSettings($id)
    {
        $virtualServer  = $this->getVirtualServer($id);
        $manager = $this->serverManager($id);
        $onlineConfigs = [];

        $configs = [
            "virtualserver_name"        =>  $manager["virtualserver_name"],
            "virtualserver_status"      =>  $manager["virtualserver_status"],
            "host"                      =>  $virtualServer->host,
        ];

        if($manager['virtualserver_status'] == "online")
        {
            $onlinePermissions = [
                'virtualserver_password',
                'virtualserver_uptime',
                'virtualserver_hostmessage',
                'virtualserver_hostmessage_mode',
                'virtualserver_platform',
                'virtualserver_created',
                'virtualserver_version',
                'virtualserver_welcomemessage',
                'virtualserver_min_client_version',
                'virtualserver_hostbanner_url',
                'virtualserver_hostbanner_gfx_url',
                'virtualserver_hostbanner_gfx_interval',
                'virtualserver_hostbanner_mode',
            ];
            foreach($onlinePermissions as $permission)
            {
                $onlineConfigs[$permission] = $manager[$permission];
            }
        }

        return array_merge_recursive($configs , $onlineConfigs , ['slots'   =>  $manager['virtualserver_clientsonline']-$manager['virtualserver_queryclientsonline']. "/" .$manager['virtualserver_maxclients']]);
    }
}
