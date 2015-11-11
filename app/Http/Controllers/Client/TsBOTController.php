<?php

namespace NpTS\Http\Controllers\Client;

use Illuminate\Http\Request;

use NpTS\Http\Requests;
use NpTS\Http\Controllers\Controller;

class TsBOTController extends Controller
{
    public function index()
    {
        return view('Client.Bot.index');
    }
}
