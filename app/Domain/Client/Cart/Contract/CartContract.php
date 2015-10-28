<?php

namespace NpTS\Domain\Client\Cart\Contract;

interface CartContract
{
    public function add();
    public function remove();

    public function addVoucher();
    public function addCupom();

    public function all();
    public function total();

    public function reset();

    public function count();

    public function save();
}