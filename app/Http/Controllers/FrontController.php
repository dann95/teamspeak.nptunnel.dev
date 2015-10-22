<?php

namespace NpTS\Http\Controllers;

use Illuminate\Http\Request;
use NpTS\Http\Requests;
use NpTS\Http\Controllers\Controller;

use NpTS\Domain\Admin\Repositories\Contracts\PlanRepositoryContract;
use NpTS\Domain\Client\Repositories\Contracts\VirtualServerRepositoryContract;

class FrontController extends Controller
{
    private $planRepository;
    private $virtualServerRepository;
    public function __construct(PlanRepositoryContract $planRepository , VirtualServerRepositoryContract $virtualServerRepository)
    {
        $this->planRepository = $planRepository;
        $this->virtualServerRepository = $virtualServerRepository;
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
