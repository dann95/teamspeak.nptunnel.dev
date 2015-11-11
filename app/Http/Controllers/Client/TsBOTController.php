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
    public function index($id)
    {
        $bot = $this->vserverRepository->find($id);
        if(! $bot or ! ($this->guard->user()->id == $bot->user_id))
        {
            return abort(403);
        }
        $bot = $bot->bot;
        return view('Client.Bot.index' , compact('bot'));
    }
}
