<?php

namespace NpTS\Domain\Client\Cart;

use Illuminate\Support\Facades\Session;
use NpTS\Domain\Client\Cart\Contract\CartContract;

class Cart implements CartContract
{

    private $cart = [];
    private $voucher = [];
    private $cupom = [];

    public function __construct()
    {

    }

    public function add(array $options)
    {
        $this->cart[$this->getNextId()] = $options;
        return $this;
    }

    public function remove($id)
    {
        if(isset($this->cart[$id]))
        {
            unset($this->cart[$id]);
        }
        return $this;
    }

    public function addVoucher()
    {
        // TODO: Implement addVoucher() method.
        return $this;
    }

    public function addCupom()
    {
        // TODO: Implement addCupom() method.
        return $this;
    }

    /**
     * get all items of the cart.
     * @return array
     */
    public function all()
    {
        return $this->cart;
    }

    /**
     * @return float
     */
    public function total()
    {
        $priceTotal = 0;
        foreach($this->cart as $compra)
        {
            $priceTotal += $compra['plan']->price;
        }
        return $priceTotal;
    }

    /**
     * Remove all items of cart.
     * @return $this
     */
    public function reset()
    {
        $this->cart = [];
        return $this;
    }

    /**
     * Count items of the cart.
     * @return int
     */
    public function count()
    {
        return count($this->cart);
    }

    /**
     * Persist items to session.
     * @return $this
     */
    public function save()
    {
        Session::put('cart',$this);
        return $this;
    }

    /**
     * Get the next id to the cart.
     * @return int
     */
    private function getNextId()
    {
        $keys = array_keys($this->cart);
        $end = end($keys);
        if(! $end)
        {
            return 1;
        }
        else
        {
            return $end+1;
        }
    }

    public function finish()
    {
        return [
            'items' =>  collect($this->cart),
            'cupoms'    =>  $this->cupom,
            'vouchers'  =>  $this->voucher,
        ];
    }
}