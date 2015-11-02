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
        $server = $this->repository->find($id);
        return view('Admin.Server.edit',compact('server'));
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
        $this->validate($request , [
            'name'          =>  ['required','min:3','max:20',],
            'ip'            =>  ['required','ip',],
            'dns'           =>  ['required','active_url:A'],
            'user'          =>  ['required','min:3','max:20'],
            'password'      =>  ['required','min:6','max:40'],
            'max_slots'     =>  ['required','int'],
        ] , [
            'name.required'         =>  'Você deve inserir um nome!',
            'name.min'              =>  'O nome deve conter mínimo 3 digitos',
            'name.max'              =>  'O nome deve conter máximo 20 digitos',

            'ip.required'           =>  'Você deve inserir o ip do servidor',
            'ip.ip'                 =>  'Insira um ip valido',

            'dns.required'          =>  'Insira um dns',
            'dns.active_url'        =>  'Esse não é um dns válido',

            'user.required'         =>  'Insira um usuario do ServerQuery',
            'user.min'              =>  'O usuario deve conter mínimo 3 digitos',
            'user.max'              =>  'O usuario deve conter máximo 20 digitos',

            'password.required'     =>  'Você deve inserir a senha',
            'password.min'          =>  'A senha deve conter mínimo 6 digitos',
            'password.max'          =>  'A senha deve conter máximo 40 digitos',

            'max_slots.required'    =>  'Insira a quantidade de slots',
            'max_slots.int'         =>  'A quantidade de slots deve ser um numero',
        ]);
        $this->repository->update($id , $request->only([
            'name',
            'ip',
            'dns',
            'user',
            'password',
            'max_slots'
        ]));
        return redirect()->route('server.index');
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
