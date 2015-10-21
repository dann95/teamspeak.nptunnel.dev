<?php

namespace NpTS\Http\Controllers;

use Illuminate\Http\Request;
use NpTS\Http\Requests;
use NpTS\Http\Controllers\Controller;

use NpTS\Domain\Admin\Repositories\Contracts\PlanRepositoryContract;

class FrontController extends Controller
{
    private $planRepository;
    public function __construct(PlanRepositoryContract $planRepository)
    {
        $this->planRepository = $planRepository;
    }
    /**
     * Index
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $planos = $this->planRepository->actives();
        return view('Front.index' , compact('planos'));
    }
}
