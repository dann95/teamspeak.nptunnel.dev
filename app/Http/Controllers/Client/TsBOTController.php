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
use NpTS\Domain\Bot\Models\Guild as GuildModel;
use NpTS\Domain\Bot\Models\Character as CharacterModel;
use NpTS\Domain\Client\Requests\UpdateCharacterRequest;
use NpTS\Domain\Client\Requests\InstallTsBOTRequest;
class TsBOTController extends Controller
{
    private $vserverRepository;
    private $guard;
    private $service;
    private $guildService;
    private $worldModel;
    private $characterModel;
    public function __construct(VirtualServerRepositoryContract $repo, Guard $guard, Character $service, Guild $guild , World $world , CharacterModel $characterModel , GuildModel $guildModel)
    {
        parent::__construct();
        $this->vserverRepository = $repo;
        $this->guard = $guard;
        $this->service = $service;
        $this->guildService = $guild;
        $this->worldModel = $world;
        $this->characterModel = $characterModel;
        $this->guildModel = $guildModel;
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($id)
    {
        $bot = $this->getBot($id);
        if(! $bot->is_installed)
            return redirect()->route('account.virtual.bot.install',['id' => $id]);

        return view('Client.Bot.index', compact('bot'));
    }

    public function setup($id)
    {
        $vserver = $this->getVserver($id);
        return view('Client.Bot.install' , compact('id'));
    }

    public function install($id , InstallTsBOTRequest $request)
    {
        $vserver = $this->getVserver($id);
        $vserver->bot->update([
            'name'      =>  $request->name,
            'login'     =>  $request->login,
            'password'  =>  $request->password,
            'is_installed' =>  true,
        ]);
        return redirect()->route('account.virtual.bot.index',['id' => $id]);
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
        $settings = array_map(function($element){
            if($element === null)
                return false;
            return $element;
        } , $request->only(['enemy_ch_id','friend_ch_id','world_id','rashid_ch_id','blue_ch_id','green_ch_id','resp_ch_id','resp_num_ch_id','show_resp','show_rashid','show_green','show_blue']));
        $bot->tibiaList->update($settings);
        return redirect()->route('account.virtual.bot.tibiaSettings',['id' => $id]);
    }

    public function settings($id , ChangeTsBotSettingsRequest $request)
    {
        $bot = $this->getBot($id);
        $bot->update($request->only(['tibia_list','auto_afk']));
        return redirect()->route('account.virtual.bot.index',['id' => $id]);
    }


    public function afk($id)
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

        return view('Client.Bot.afk' , compact('bot','channels'));
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


    public function listGuildsFriend($id)
    {
        $bot = $this->getBot($id);
        return view('Client.Bot.list_guilds_friend',compact('bot'));
    }

    public function listGuildsEnemy($id)
    {
        $bot = $this->getBot($id);
        return view('Client.Bot.list_guilds_enemy',compact('bot'));
    }
    public function del($id , $char_id)
    {
        $bot = $this->getBot($id);
        $character = $this->getCharacter($char_id);
        if(! ($character->tibia_list_id == $bot->tibiaList->id) )
        {
            return abort(403);
        }
        $character->delete();
        return redirect()->route('account.virtual.bot.friend.index' , ['id' => $id]);
    }

    public function delEnemy($id , $char_id)
    {
        $bot = $this->getBot($id);
        $character = $this->getCharacter($char_id);
        if(! ($character->tibia_list_id == $bot->tibiaList->id) )
        {
            return abort(403);
        }
        $character->delete();
        return redirect()->route('account.virtual.bot.enemy.index' , ['id' => $id]);
    }

    public function editChar($id , $char_id)
    {
        $bot = $this->getBot($id);
        $character = $this->getCharacter($char_id);
        if(! ($character->tibia_list_id == $bot->tibiaList->id) )
        {
            return abort(403);
        }
        return view('Client.Bot.edit_char' , compact('bot','character'));
    }

    public function updateChar($id , $char_id , UpdateCharacterRequest $request)
    {
        $bot = $this->getBot($id);
        $character = $this->getCharacter($char_id);
        if(! ($character->tibia_list_id == $bot->tibiaList->id) )
        {
            return abort(403);
        }
        $character->update($request->only('position'));
        return redirect()->back();
    }

    public function delGuild($id , $guild_id)
    {
        $bot = $this->getBot($id);
        $guild = $this->getGuild($guild_id);
        if(! ($guild->tibia_list_id == $bot->tibiaList->id))
        {
            return abort(403);
        }
        $this->guildService->remove($guild);
        return redirect()->back();
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


    private function getCharacter($id)
    {
        $char = $this->characterModel->find($id);
        if(! $char)
        {
            return abort(403);
        }
        return $char;
    }

    private function getGuild($id)
    {
        $guild = $this->guildModel->find($id);
        if(! $guild)
        {
            return abort(403);
        }
        return $guild;
    }

    private function getVserver($id)
    {
        $vserver = $this->vserverRepository->find($id);
        if (!$vserver or !($this->guard->user()->id == $vserver->user_id)) {
            return abort(403);
        }
        return $vserver;
    }
}

