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
    }

    private function users()
    {
        // Users:
        factory(NpTS\Domain\Client\Models\User::class , 100)->create()->each(function($user){
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
}
