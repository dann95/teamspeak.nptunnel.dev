@extends('Client.Layout.default')
@section('title','Minha conta')
@section('content')
    <div class="col-lg-6">
    <div class="col-lg-12">
        <div class="form-panel">
            <h4 class="mb"><i class="fa fa-angle-right"></i> Atualizar informações da conta</h4>
            <form class="form-horizontal style-form" method="POST" action="http://www.gamespeak.r2d2bot.net/account/virtual/1/change-messages">
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="col-sm-2 control-label">Meu nome</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="virtualserver_name" value="{{ $auth->user()->name }}">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-9">

                    </div>
                    <div id="col-sm-3">
                        <button type="submit" class="btn btn-primary">Atulizar informações</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
    </div>
    <div class="col-lg-6">
        <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb"><i class="fa fa-angle-right"></i> Trocar minha senha</h4>
                <form class="form-horizontal style-form" method="POST" action="{{ route('account.password') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Senha Atual</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="current_password" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nova senha</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="password" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Confirme a nova senha</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="password_confirmation" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-9">

                        </div>
                        <div id="col-sm-3">
                            <button type="submit" class="btn btn-primary">trocar minha senha</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection