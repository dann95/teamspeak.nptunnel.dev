<?php

namespace NpTS\Domain\Client\Cart\Contract;

interface CartContract
{
    public function add(array $options);
    public function remove($id);
    public function addVoucher();
    public function addCupom();
    public function all();
    public function total();
    public function reset();
    public function count();
    public function save();
}