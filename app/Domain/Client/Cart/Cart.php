<?php

namespace NpTS\Domain\Client\Cart;

use Illuminate\Support\Facades\Session;
use NpTS\Domain\Client\Cart\Contract\CartContract;

class Cart implements CartContract
{

    private $cart = [];

    public function __construct()
    {

    }

    public function add()
    {
        $this->cart[] = '123';
        return $this;
    }

    public function remove()
    {
        // TODO: Implement remove() method.
    }

    public function addVoucher()
    {
        // TODO: Implement addVoucher() method.
    }

    public function addCupom()
    {
        // TODO: Implement addCupom() method.
    }

    public function all()
    {
        // TODO: Implement all() method.
    }

    public function total()
    {
        // TODO: Implement total() method.
    }

    public function reset()
    {
        // TODO: Implement reset() method.
    }

    public function count()
    {
        return count($this->cart);
    }

    public function save()
    {
        Session::put('cart',$this);
        return $this;
    }
}