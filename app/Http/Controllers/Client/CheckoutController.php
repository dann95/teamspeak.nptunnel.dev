<?php

namespace NpTS\Http\Controllers\Client;

use Illuminate\Http\Request;
use NpTS\Http\Requests;
use NpTS\Http\Controllers\Controller;
use NpTS\Domain\Client\Repositories\Contracts\InvoiceRepositoryContract;

class CheckoutController extends Controller
{
    private $invoiceRepository;
    public function __construct(InvoiceRepositoryContract $invoiceRepository)
    {
        parent::__construct();
        $this->invoiceRepository = $invoiceRepository;
    }
    public function index()
    {
        if(! \Session::get('cart')->count())
            return redirect()->route('account.cart.index')->withErrors(['O carrinho está vazio! :(']);
        return view('Client.Checkout.index');
    }
    public function checkout()
    {
        // TODO: Payment Logic

        // TODO: Create Invoice

        // TODO: Show the invoice and fire email.
    }
}
