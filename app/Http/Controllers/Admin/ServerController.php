<?php

namespace NpTS\Http\Controllers\Admin;

use Illuminate\Http\Request;
use NpTS\Http\Requests;
use NpTS\Http\Controllers\Controller;
use NpTS\Domain\Admin\Repositories\Contracts\ServerRepositoryContract;
use NpTS\Domain\Admin\Requests\AdminCreateServerRequest;

class ServerController extends Controller
{

    private $repository;
    public function __construct(ServerRepositoryContract $repository)
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
        $servers = $this->repository->all();
        return view('Admin.Server.index' , compact('servers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Server.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminCreateServerRequest $request)
    {
        $this->repository
            ->create($request
            ->only([
                'name',
                'ip',
                'dns',
                'user',
                'password',
                'max_slots'
            ]));
        return redirect()->route('server.index');
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


    public function active($id)
    {
        $server = $this->repository->find($id);
        if($server && $server->active)
        {
            $server->active = 0;
            $server->save();
        }
        elseif($server && !($server->active))
        {
            $server->active = 1;
            $server->save();
        }
        return redirect()->route('server.index');
    }

    public function activeSales($id)
    {
        $server = $this->repository->find($id);
        if($server && $server->active_sales)
        {
            $server->active_sales = 0;
            $server->save();
        }
        elseif($server && !($server->active_sales))
        {
            $server->active_sales = 1;
            $server->save();
        }
        return redirect()->route('server.index');
    }
}
