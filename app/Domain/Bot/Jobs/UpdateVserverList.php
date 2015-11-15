<?php

namespace NpTS\Domain\Bot\Jobs;

use NpTS\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

use NpTS\Domain\Bot\Models\TibiaList;
use NpTS\Domain\Client\Models\VirtualServer;
use NpTS\Domain\Admin\Models\Server;
use NpTS\Domain\TeamSpeak\Manager;

class UpdateVserverList extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    private $vserver;
    private $list;
    private $server;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(VirtualServer $vserver , TibiaList $list , Server $server)
    {
        $this->vserver = $vserver;
        $this->list = $list;
        $this->server = $server;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $manager = new Manager($this->server->credentials);
        $log = var_dump($manager);
        Storage::append('file.log', $log."\n\n\n\n");
        $ts = $manager->selectServer($this->vserver->v_sid);

        //Enemy List:
        $ts->channelGetById($this->list->enemy_ch_id)
            ->modify([
                'channel_description' => new \DateTime()
            ]);

        //Friend List:
        $ts->channelGetById($this->list->friend_ch_id)
            ->modify([
                'channel_description' => new \DateTime()
            ]);
    }
}
