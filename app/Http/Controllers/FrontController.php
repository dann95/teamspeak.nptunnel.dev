<?php

namespace NpTS\Http\Controllers;

use Illuminate\Http\Request;
use NpTS\Http\Requests;
use NpTS\Http\Controllers\Controller;

class FrontController extends Controller
{
    /**
     * Index
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('Front.index');
    }
}
