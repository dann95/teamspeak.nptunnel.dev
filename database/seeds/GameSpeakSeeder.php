<?php

use Illuminate\Database\Seeder;

class GameSpeakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->users();
        $this->invoiceStatus();
        $this->questionCategory();
        $this->plan();
        $this->server();
        $this->ipCralwer();
        $this->worlds();
        $this->vocations();
    }

    private function users()
    {
        // Users:
        factory(NpTS\Domain\Client\Models\User::class , 5)->create()->each(function($user){
            $n = mt_rand(0,10);
            if($n)
            {
                for($i=1; $i <= $n; $i++)
                {
                    $user->questions()->save(factory(NpTS\Domain\HelpDesk\Models\Question::class)->make());
                }
            }
        });
        \NpTS\Domain\Client\Models\User::create([
            'name'  =>  'Daniel Rubin',
            'email'  =>  'eu@drub.in',
            'password'  =>  bcrypt('gamespeak99'),
            'is_admin'  =>  1
        ]);
    }

    private function invoiceStatus()
    {
        $status = [
            'Cancelado',
            'Aguardando Pagamento',
            'Pagamento Confirmado',
            'Serviço Entregue'
        ];

        for($i = 0; $i <= count($status)-1; $i++)
        {
            \NpTS\Domain\Client\Models\InvoiceStatus::create([
                'id' => $i,
                'status' => $status[$i]
            ])->save();
        }
    }

    private function questionCategory()
    {
        $categories = [
            'Financeiro',
            'Suporte',
            'Vendas'
        ];
        foreach($categories as $category)
        {
            \NpTS\Domain\HelpDesk\Models\QuestionCategory::create([
                'name' => $category
            ])->save();
        }
    }

    private function plan()
    {
        for($i=1; $i<=8; $i++)
        {
            \NpTS\Domain\Admin\Models\Plan::create([
               'name' => 'GameSpeak#0'.$i,
                'slots' =>  $i*10,
                'active'    =>  1,
                'price' =>  5.99*$i,
            ]);
        }
    }

    private function server()
    {
        \NpTS\Domain\Admin\Models\Server::create([
            'ip'    =>  env('THOMASIP'),
            'name'  =>  'Dedicada#1',
            'dns'   =>  'ts001.r2d2bot.net',
            'user'  =>  'serveradmin',
            'password'  =>  env('THOMASPWD'),
            'max_slots' =>  2000,
            'active'    =>  1,
            'active_sales'  =>  1,
        ]);
    }

    private function ipCralwer()
    {
        $ips = config('ips');
        foreach($ips as $ip)
        {
            \NpTS\Domain\Bot\Models\CrawlerIp::create(
                ['ip' => $ip ,
                'usage' => 0
                ]
            );
        }
    }
    private function worlds()
    {

        $worlds = [
            "Amera",
            "Antica",
            "Astera",
            "Aurea",
            "Aurera",
            "Aurora",
            "Bellona",
            "Beneva",
            "Calmera",
            "Calva",
            "Calvera",
            "Candia",
            "Celesta",
            "Chrona",
            "Danera",
            "Dolera",
            "Efidia",
            "Eldera",
            "Elera",
            "Elysia",
            "Fidera",
            "Fortera",
            "Garnera",
            "Guardia",
            "Harmonia",
            "Honera",
            "Hydera",
            "Inferna",
            "Iona",
            "Irmada",
            "Julera",
            "Justera",
            "Kenora",
            "Kronera",
            "Luminera",
            "Magera",
            "Menera",
            "Morta",
            "Mortera",
            "Neptera",
            "Nerana",
            "Nika",
            "Olympa",
            "Pacera",
            "Premia",
            "Pythera",
            "Quilia",
            "Refugia",
            "Rowana",
            "Secura",
            "Shivera",
            "Silvera",
            "Solera",
            "Tenebra",
            "Thera",
            "Umera",
            "Unitera",
            "Valoria",
            "Veludera",
            "Vinera",
            "Xantera",
            "Yanara",
            "Zanera",
        ];

       foreach($worlds as $world)
       {
           \NpTS\Domain\Bot\Models\World::create([
               'name' => $world
           ]);
       }
    }

    private function vocations()
    {
        $vocs = [
            "Elder Druid"=>"http://i.imgur.com/I6l1sAf.gif",
            "Master Sorcerer"=>"http://i.imgur.com/9TyYzhu.png",
            "Elite Knight"=>"http://i.imgur.com/nb8nrub.png",
            "Royal Paladin"=>"http://i.imgur.com/JYv7sw3.png",
            "Knight"=>"http://i.imgur.com/Lx5g53w.png",
            "Sorcerer"=>"http://i.imgur.com/tZbDxtS.png",
            "Druid"=>"http://i.imgur.com/eDj9TW2.png",
            "Paladin"=>"http://i.imgur.com/aRo6CDS.png",
            "None"=>"http://i.imgur.com/gBMhGlz.gif",
        ];

        foreach($vocs as $voc => $url)
        {
            \NpTS\Domain\Bot\Models\Vocation::create([
                'name' => $voc,
                'url_icon' => $url,
            ]);
        }
    }
}
