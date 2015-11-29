<?php

namespace NpTS\Domain\Bot\Commands;

use Illuminate\Console\Command;

use NpTS\Domain\Bot\Models\TsBot;

use TeamSpeak3\Ts3Exception;
use TeamSpeak3\TeamSpeak3;
use TeamSpeak3\Helper\Signal;
use TeamSpeak3\Adapter\ServerQuery\Event;
use Teamspeak3\Node\Host;

class R2d2 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'r2d2:bot';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Try Connect in all teamspeaks for wait for commands.';


    private $TsBotModel;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->TsBotModel = app(TsBot::class);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //todo: Select Every TsBOT
        $bots = $this->TsBotModel->all();


        $bots->each(function($bot){
            $credentials = $bot->vserver->server()->credentials;

            $ts = TeamSpeak3::factory("serverquery://{$credentials['user']}:{$credentials['password']}@{$credentials['ip']}:10011/?server_port={$bot->vserver->port}&blocking=0&nick=TS_BOT");

            // get notified on incoming private messages
            $ts->notifyRegister("textprivate");
            Signal::getInstance()->subscribe("notifyTextmessage", array($this,'onTextmessage'));

            dd(Signal::getInstance());

            while(true)
            {
                $ts->getAdapter()->wait();
            }

        });

    }

    public function onTextMessage(Event $e, Host $host) {
        $info = $e->getData();
        $srv = $host->serverGetSelected();
        switch ($info["targetmode"]) {
            case 1:
                echo "New Private Message from " . $info["invokername"]->toString() . ": " . $info["msg"] . "\n";
                break;
            case 2:
                echo "New Message from " . $info["invokername"]->toString() . " in Channel " . $srv->channelGetById($host->whoamiGet("client_channel_id"))->toString() . ": " . $info["msg"] . "\n";
                break;
            case 3:
                echo "New Server Message from " . $info["invokername"]->toString() . ": " . $info["msg"] . "\n";
                break;
        }
    }
}
