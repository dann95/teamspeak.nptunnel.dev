<?php

namespace NpTS\Http\Controllers\Client;

use Illuminate\Http\Request;
use NpTS\Http\Requests;
use NpTS\Http\Controllers\Controller;

class AccountController extends Controller
{
    public function index()
    {
        return view('Client.Account.index');
    }

    public function invoices()
    {
        return view('Client.Account.invoices');
    }


}
