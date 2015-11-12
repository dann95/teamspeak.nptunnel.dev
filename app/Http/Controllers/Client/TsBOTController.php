<?php

namespace NpTS\Http\Controllers\Client;

use Illuminate\Http\Request;

use NpTS\Http\Requests;
use NpTS\Http\Controllers\Controller;
use NpTS\Domain\Client\Repositories\Contracts\VirtualServerRepositoryContract;
use Illuminate\Auth\Guard;

class TsBOTController extends Controller
{
    private $vserverRepository;
    private $guard;
    public function __construct(VirtualServerRepositoryContract $repo , Guard $guard)
    {
        parent::__construct();
        $this->vserverRepository = $repo;
        $this->guard = $guard;
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($id)
    {
        $bot = $this->getBot($id);
        return view('Client.Bot.index' , compact('bot'));
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listFriends($id)
    {
        $bot = $this->getBot($id);
        return view('Client.Bot.list_friends' , compact('bot'));
    }

    /**
     * @param $vserverId
     */
    private function getBot($vserverId)
    {
        $vserver = $this->vserverRepository->find($vserverId);
        if(! $vserver or ! ($this->guard->user()->id == $vserver->user_id))
        {
            return abort(403);
        }
        return $vserver->bot;
    }
}
