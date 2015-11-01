<?php

namespace NpTS\Http\Controllers\Client;

use Illuminate\Http\Request;
use NpTS\Http\Requests;
use NpTS\Http\Controllers\Controller;
use NpTS\Domain\Client\Repositories\Contracts\InvoiceRepositoryContract;

use NpTS\Domain\Client\Service\VirtualServer;

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
        // Armazenando o carrinho em uma var.
        $cart = \Session::get('cart');
        // Abortar caso carrinho esteja vazio.
        if(! $cart->count())
            return redirect()->route('account.cart.index')->withErrors(['O carrinho está vazio! :(']);

        // TODO: Payment Logic

        // Create Invoice
        $invoice = $this->invoiceRepository->create(
            $cart->finish()
        );
        // Reset the cart:
        $cart->reset()
            ->save();

        // TODO: Show the invoice and fire email.

        // @TEST
        $test = app(VirtualServer::class);
        $test->create(
            $invoice
        );
        // /@TEST

        return view('Client.Checkout.success_invoice' , compact('invoice'));
    }
}
