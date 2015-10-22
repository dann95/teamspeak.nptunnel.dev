<?php

namespace NpTS\Http\Controllers;

use Illuminate\Http\Request;
use NpTS\Http\Requests;
use NpTS\Http\Controllers\Controller;

class StoreController extends Controller
{
    public function index()
    {
        $planos = [];
        return view('Front.index',compact('planos'));
    }
}
