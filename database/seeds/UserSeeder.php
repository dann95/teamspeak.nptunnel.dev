<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(NpTS\Domain\Client\Models\User::class , 30)->create()->each(function($user){
            $n = mt_rand(0,10);
            if($n)
            {
                for($i=1; $i <= $n; $i++)
                {
                $user->questions()->save(factory(NpTS\Domain\HelpDesk\Models\Question::class)->make());
                }
            }
        });
    }
}
