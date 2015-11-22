<?php

namespace NpTS\Http\Controllers\Client;

use NpTS\Domain\Bot\Requests\ChangeTsBotSettingsRequest;
use NpTS\Domain\Bot\Service\Exceptions\CharacterDosntExists;
use NpTS\Domain\Bot\Service\Exceptions\CharacterAlreadyInThisList;
use NpTS\Domain\Bot\Service\Exceptions\GuildAlreadyInThisList;
use NpTS\Domain\Bot\Service\Exceptions\GuildDosntExists;
use NpTS\Http\Requests;
use NpTS\Http\Controllers\Controller;
use NpTS\Domain\Client\Repositories\Contracts\VirtualServerRepositoryContract;
use Illuminate\Auth\Guard;
use NpTS\Domain\Bot\Requests\InsertCharacterRequest;
use NpTS\Domain\Bot\Requests\InsertGuildRequest;
use NpTS\Domain\Bot\Service\Character;
use NpTS\Domain\Bot\Service\Guild;
use NpTS\Domain\TeamSpeak\Manager;
use NpTS\Domain\Bot\Requests\UpdateTibiaSettingsRequest;
use TeamSpeak3\Ts3Exception;
use NpTS\Domain\Bot\Models\World;

class TsBOTController extends Controller
{
    private $vserverRepository;
    private $guard;
    private $service;
    private $guildService;
    private $worldModel;
    public function __construct(VirtualServerRepositoryContract $repo, Guard $guard, Character $service, Guild $guild , World $world)
    {
        parent::__construct();
        $this->vserverRepository = $repo;
        $this->guard = $guard;
        $this->service = $service;
        $this->guildService = $guild;
        $this->worldModel = $world;
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($id)
    {
        $bot = $this->getBot($id);
        $vserver = $bot->vserver;
        $manager = new Manager($vserver->server()->get()->first()->credentials);
        try{
            $ts = $manager->selectServer($vserver->v_sid);
            $channels = $ts->channelList();
        }catch(Ts3Exception $e)
        {
            $channels = [];
        }
        return view('Client.Bot.index', compact('bot','channels'));
    }

    public function tibia($id)
    {
        $bot = $this->getBot($id);
        $vserver = $bot->vserver;
        $worlds = $this->worldModel->all();
        $manager = new Manager($vserver->server()->get()->first()->credentials);
        try{
            $ts = $manager->selectServer($vserver->v_sid);
            $channels = $ts->channelList();
        }catch(Ts3Exception $e)
        {
            $channels = [];
        }
        return view('Client.Bot.tibia', compact('bot','channels','worlds'));
    }

    public function tibiaSettings($id , UpdateTibiaSettingsRequest $request)
    {
        $bot = $this->getBot($id);
        $bot->tibiaList->update($request->only(['enemy_ch_id','friend_ch_id','world_id']));
        return redirect()->route('account.virtual.bot.tibiaSettings',['id' => $id]);
    }

    public function settings($id , ChangeTsBotSettingsRequest $request)
    {
        $bot = $this->getBot($id);
        $bot->update($request->only(['tibia_list','auto_afk','afk_ch_id','max_afk_time']));
        return redirect()->route('account.virtual.bot.index',['id' => $id]);
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listFriends($id)
    {
        $bot = $this->getBot($id);
        return view('Client.Bot.list_friends', compact('bot'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listEnemies($id)
    {
        $bot = $this->getBot($id);
        return view('Client.Bot.list_enemies', compact('bot'));
    }

    public function add($id)
    {
        $bot = $this->getBot($id);
        return view('Client.Bot.insert_friend', compact('bot'));
    }

    public function addEnemy($id)
    {
        $bot = $this->getBot($id);
        return view('Client.Bot.insert_enemy', compact('bot'));
    }

    public function storeFriend($id, InsertCharacterRequest $request)
    {
        $bot = $this->getBot($id);
        try {
            $this->service->insert($bot->tibiaList, $request->only('name')['name'], 1);
        } catch (CharacterDosntExists $e) {
            return redirect()->route('account.virtual.bot.friend.add', ['id' => $id])->withErrors([$request->only('name')['name'] . ' Não existe!']);
        } catch (CharacterAlreadyInThisList $e) {
            return redirect()->route('account.virtual.bot.friend.add', ['id' => $id])->withErrors([$request->only('name')['name'] . ' Já está nessa lista!']);
        }
        return redirect()->route('account.virtual.bot.friend.index', ['id' => $id]);
    }

    public function storeEnemy($id, InsertCharacterRequest $request)
    {
        $bot = $this->getBot($id);
        try {
            $this->service->insert($bot->tibiaList, $request->only('name')['name'], 0);
        } catch (CharacterDosntExists $e) {
            return redirect()->route('account.virtual.bot.enemy.add', ['id' => $id])->withErrors([$request->only('name')['name'] . ' Não existe!']);
        } catch (CharacterAlreadyInThisList $e) {
            return redirect()->route('account.virtual.bot.enemy.add', ['id' => $id])->withErrors([$request->only('name')['name'] . ' Já está nessa lista!']);
        }
        return redirect()->route('account.virtual.bot.enemy.index', ['id' => $id]);
    }

    public function addGuild($id)
    {
        $bot = $this->getBot($id);
        return view('Client.Bot.insert_guild_friend', compact('bot'));
    }

    public function storeGuildFriend($id, InsertGuildRequest $request)
    {
        $bot = $this->getBot($id);
        try{
        $this->guildService->insert($bot->tibiaList, $request->only('name')['name'], 1);
        }catch (GuildDosntExists $e)
        {
            return redirect()->route('account.virtual.bot.friend.guild.add' , ['id' => $id])->withErrors(['Guild com esse nome não existe!']);
        }catch(GuildAlreadyInThisList $e)
        {
            return redirect()->route('account.virtual.bot.friend.guild.add' , ['id' => $id])->withErrors(['Guild com esse nome já está na lista!']);
        }
        return redirect()->route('account.virtual.bot.friend.index', ['id' => $id]);
    }


    public function addGuildEnemy($id)
    {
        $bot = $this->getBot($id);
        return view('Client.Bot.insert_guild_enemy', compact('bot'));
    }

    public function storeGuildEnemy($id, InsertGuildRequest $request)
    {
        $bot = $this->getBot($id);
        try{
            $this->guildService->insert($bot->tibiaList, $request->only('name')['name'], 0);
        }catch (GuildDosntExists $e)
        {
            return redirect()->route('account.virtual.bot.enemy.guild.add' , ['id' => $id])->withErrors(['Guild com esse nome não existe!']);
        }catch(GuildAlreadyInThisList $e)
        {
            return redirect()->route('account.virtual.bot.enemy.guild.add' , ['id' => $id])->withErrors(['Guild com esse nome já esta na lista!']);
        }

        return redirect()->route('account.virtual.bot.enemy.index', ['id' => $id]);
    }


    /**
     * @param $vserverId
     */
    private function getBot($vserverId)
    {
        $vserver = $this->vserverRepository->find($vserverId);
        if (!$vserver or !($this->guard->user()->id == $vserver->user_id)) {
            return abort(403);
        }
        return $vserver->bot;
    }
}
