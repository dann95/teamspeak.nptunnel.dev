<?php

namespace NpTS\Domain\Bot\Jobs;

use NpTS\Domain\Bot\Service\Exceptions\CharacterAlreadyInThisList;
use NpTS\Domain\Bot\Service\Exceptions\CharacterDosntExists;
use NpTS\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

use NpTS\Domain\Bot\Models\TibiaList;
use NpTS\Domain\Bot\Service\Character;

class AddCharacter extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    private $tibiaList;
    private $char;
    private $position;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(TibiaList $tibiaList , $char , $position)
    {
        $this->tibiaList = $tibiaList;
        $this->char = $char;
        $this->position = $position;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Character $service)
    {
        try{
            $service->insert($this->tibiaList , $this->char , $this->position);
        }catch (CharacterDosntExists $e){

        }catch(CharacterAlreadyInThisList $e)
        {

        }
    }
}
