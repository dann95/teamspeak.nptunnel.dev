@extends('Admin.Layout.default')
@section('title','Editar um server')
@section('content')
    @if($server)
        <!-- BASIC FORM ELELEMNTS -->
        <div class="row mt">
            <div class="col-lg-6">
                <div class="form-panel">
                    <h4 class="mb"><i class="fa fa-angle-right"></i> Preencha o formulario</h4>
                    <form class="form-horizontal style-form" method="POST" action="{{ route('server.update' , ['id' => $server->id]) }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nome</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control" value="{{ $server->name }}">
                                <span class="help-block">Um nome descritivo para o servidor ex: <strong>NFO-DEDICADA01</strong></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">IP</label>
                            <div class="col-sm-10">
                                <input type="text" name="ip" class="form-control" value="{{ $server->ip }}">
                                <span class="help-block">IP da maquina.</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">DNS</label>
                            <div class="col-sm-10">
                                <input type="text" name="dns" class="form-control" value="{{ $server->dns }}">
                                <span class="help-block">DNS apontado a ip, ex: <strong>ts01.gamespeak.com.br</strong></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Usuario</label>
                            <div class="col-sm-10">
                                <input type="text" name="user" class="form-control" value="{{ $server->user }}">
                                <span class="help-block">Usuario da SeverQuery , por padrão: <strong>serveradmin</strong></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" name="password" class="form-control" value="{{ $server->password }}">
                                <span class="help-block">Senha do usuario de ServerQuery.</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Slots</label>
                            <div class="col-sm-10">
                                <input type="text" name="max_slots" class="form-control" value="{{ $server->max_slots }}">
                                <span class="help-block">Quantidade de slots associados a esse host.</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-9">

                            </div>
                            <div id="col-sm-3">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Atualizar servidor</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- col-lg-12-->
        </div><!-- /row -->
    @else
        <h1>Server inexistente!</h1>
    @endif
@endsection