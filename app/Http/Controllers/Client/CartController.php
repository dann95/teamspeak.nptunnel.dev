<?php

namespace NpTS\Http\Controllers\Client;

use Illuminate\Http\Request;
use NpTS\Http\Requests;
use NpTS\Http\Controllers\Controller;

use NpTS\Domain\Client\Requests\ClientCreateVirtualServerRequest;
use NpTS\Domain\Admin\Repositories\PlanRepository;

class CartController extends Controller
{
    private $planRepository;
    public function __construct(PlanRepository $planRepository)
    {
        parent::__construct();
        $this->planRepository = $planRepository;
    }
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(ClientCreateVirtualServerRequest $request)
    {
        $plan = $this->planRepository->findActiveById($request->only(['plan_id'])['plan_id']);
        if(!$plan)
        {
            return abort(403);
        }
        \Session::get('cart')->add([
            'plan'  =>  $plan,
            'name'  =>  $request->only(['name'])['name']
        ]);
        return redirect()->route('account.cart.index');
    }

    public function del($id)
    {
        \Session::get('cart')
            ->remove($id)
            ->save();
        return redirect()->route('account.cart.index');

    }

    public function index()
    {
        return view('Client.Cart.index');
    }
}
