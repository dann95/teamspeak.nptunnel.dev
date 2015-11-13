<?php

namespace NpTS\Http\Controllers\Client;

use Illuminate\Http\Request;

use NpTS\Domain\Bot\Service\Exceptions\CharacterDosntExists;
use NpTS\Domain\Bot\Service\Exceptions\CharacterAlreadyInThisList;
use NpTS\Http\Requests;
use NpTS\Http\Controllers\Controller;
use NpTS\Domain\Client\Repositories\Contracts\VirtualServerRepositoryContract;
use Illuminate\Auth\Guard;

use NpTS\Domain\Bot\Requests\InsertCharacterRequest;
use NpTS\Domain\Bot\Service\Character;

class TsBOTController extends Controller
{
    private $vserverRepository;
    private $guard;
    private $service;
    public function __construct(VirtualServerRepositoryContract $repo , Guard $guard , Character $service)
    {
        parent::__construct();
        $this->vserverRepository = $repo;
        $this->guard = $guard;
        $this->service = $service;
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

    public function add($id)
    {
        $bot = $this->getBot($id);
        return view('Client.Bot.insert_friend' , compact('bot'));
    }

    public function storeFriend($id , InsertCharacterRequest $request)
    {
        $bot = $this->getBot($id);
        try{
        $this->service->insert($bot->tibiaList , $request->only('name')['name'] , 1);
        }catch (CharacterDosntExists $e)
        {
            return redirect()->route('account.virtual.bot.friend.add' , ['id' => $id])->withErrors([$request->only('name')['name'].' Não existe!']);
        }catch (CharacterAlreadyInThisList $e)
        {
            return redirect()->route('account.virtual.bot.friend.add' , ['id' => $id])->withErrors([$request->only('name')['name'].' Já está nessa lista!']);
        }
        return redirect()->route('account.virtual.bot.friend.index', ['id' => $id]);
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