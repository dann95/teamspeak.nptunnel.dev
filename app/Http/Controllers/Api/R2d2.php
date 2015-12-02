<?php

namespace NpTS\Http\Controllers\Api;

use Illuminate\Http\Request;

use NpTS\Http\Requests;
use NpTS\Http\Controllers\Controller;
use NpTS\Domain\Bot\Models\TsBot;
use NpTS\Domain\Bot\Inteligence\Commands;

class R2d2 extends Controller
{
    public function credentials($api_key)
    {
        $credentials =  TsBot::where(['api_code' => $api_key])
            ->get()
            ->first();

        if(! $credentials)
            return [];

        return $credentials->credentials;
    }

    public function request($api_key , Request $request)
    {
        return (new Commands($api_key , $request))->execute();
    }
}
