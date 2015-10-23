<?php

namespace NpTS\Http\Controllers;

use Illuminate\Http\Request;
use NpTS\Http\Requests;
use NpTS\Http\Controllers\Controller;

class StoreController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('Front.index',compact('planos'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function porque()
    {
        return view('Front.porque');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function planos()
    {
        return view('Front.planos');
    }
}
