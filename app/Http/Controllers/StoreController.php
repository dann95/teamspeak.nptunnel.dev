<?php

namespace NpTS\Http\Controllers;

use Illuminate\Http\Request;
use NpTS\Http\Requests;
use NpTS\Http\Controllers\Controller;
use NpTS\Domain\Admin\Repositories\Contracts\PlanRepositoryContract;

class StoreController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('Front.index',compact('planos'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function porque()
    {
        return view('Front.porque');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function planos(PlanRepositoryContract $planRepository)
    {
        $planos = $planRepository->actives();
        return view('Front.planos' , compact('planos'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function planSelect($id , PlanRepositoryContract $planRepository)
    {
        $planos = $planRepository->actives();
        return view('Front.planSelect' , compact('planos','id'));
    }
}
