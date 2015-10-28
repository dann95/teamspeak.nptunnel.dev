<?php

namespace NpTS\Http\Controllers\Client;

use Illuminate\Http\Request;
use NpTS\Http\Requests;
use NpTS\Http\Controllers\Controller;

class CartController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(Request $request)
    {
        $cart = \Session::get('cart')
            ->add()
            ->save();
        return redirect()->route('account.cart.index');
    }

    public function index()
    {
        return view('Client.Cart.index');
    }
}
