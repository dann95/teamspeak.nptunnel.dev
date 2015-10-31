<?php

namespace NpTS\Http\Controllers\Client;

use Illuminate\Http\Request;
use NpTS\Http\Requests;
use NpTS\Http\Controllers\Controller;
use NpTS\Domain\Client\Repositories\Contracts\InvoiceRepositoryContract;
use Illuminate\Auth\Guard;

class AccountController extends Controller
{

    private $invoiceRepository;
    private $guard;
    public function __construct(InvoiceRepositoryContract $invoiceRepository , Guard $guard)
    {
        parent::__construct();
        $this->invoiceRepository = $invoiceRepository;
        $this->guard = $guard;
    }

    public function index()
    {
        return view('Client.Account.index');
    }

    public function invoices()
    {
        return view('Client.Account.invoices');
    }

    public function showInvoice($id)
    {
        $invoice = $this->invoiceRepository
            ->find($id);

        if($invoice && $invoice->user_id == $this->guard->user()->id)
        {
            return view('Client.Account.show_invoice' , compact('invoice'));
        }

        return abort(403);
    }
}
