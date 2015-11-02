<?php

namespace NpTS\Http\Controllers\Admin;

use Illuminate\Http\Request;
use NpTS\Http\Requests;
use NpTS\Http\Controllers\Controller;
use NpTS\Domain\Admin\Repositories\Contracts\PlanRepositoryContract;
use NpTS\Domain\Admin\Requests\AdminCreatePlanRequest;

class PlanController extends Controller
{
    private $repository;
    public function __construct(PlanRepositoryContract $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans = $this->repository->all();
        return view('Admin.Plan.index' , compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Plan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminCreatePlanRequest $request)
    {
        $this->repository
        ->create($request
        ->only('slots','price','name')
        );
        return redirect()->route('plan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Change status of an plan.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function power($id)
    {
        $plan = $this->repository->find($id);

        if($plan && $plan->active)
        {
            $plan->active = 0;
            $plan->save();
        }
        elseif($plan && !($plan->active))
        {
            $plan->active = 1;
            $plan->save();
        }
        return redirect()->route('plan.index');
    }
}
