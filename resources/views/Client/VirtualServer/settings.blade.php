@extends('client.layout.default')
@section('title' , 'Editar configurações do servidor')
@section('content')
<div class="row mt">
    <!-- left -->
    <div class="col-lg-6">
        <!-- power -->
        <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb"><i class="fa fa-angle-right"></i> Status do servidor</h4>
                <div class="form-horizontal style-form">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">IP:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ $configs["host"] }}">
                            <span class="help-block">Não modifique, apenas serve para exibir qual ip usar para conectar.</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-10">
                            <b>{{ $configs["virtualserver_status"] }}</b> &nbsp;&nbsp;&nbsp;<input id="power" type="checkbox" @if($configs["virtualserver_status"]=="online")checked=""@endif data-toggle="switch" />
                        </div>
                    </div>
                    @if($configs["virtualserver_status"] == "online")
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Slots</label>
                            <div class="col-sm-10">
                                {{ $configs["slots"] }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- /power-->

        @if($configs["virtualserver_status"] == "online")
            <div class="col-lg-12">
                <div class="form-panel">
                    <h4 class="mb"><i class="fa fa-angle-right"></i> Mensagens do servidor</h4>
                    <form class="form-horizontal style-form" method="POST" action="{{ route('account.virtual.messages' , ['id' => $virtualServer->id]) }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Server Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="virtualserver_name" value="{{ $configs["virtualserver_name"] }}">
                                <span class="help-block">Exibido no topo.</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Mensagem de boas vindas</label>
                            <div class="col-sm-10">
                                <textarea name="virtualserver_welcomemessage" class="form-control">{{ $configs["virtualserver_welcomemessage"] }}</textarea>
                                <span class="help-block">Exibido no serverlog quando um usuário entrar.</span>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-2 control-label">Mensagem do Host</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="virtualserver_hostmessage" value="{{ $configs["virtualserver_hostmessage"] }}">
                                <span class="help-block">Exibido quando usuário entrar, escolha abaixo a maneira.</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Exibir a Mensagem do Host da seguinte forma</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="virtualserver_hostmessage_mode">
                                    <option value="0"@if($configs["virtualserver_hostmessage_mode"] == 0){{ ' selected' }}@endif>Não exibir</option>
                                    <option value="1"@if($configs["virtualserver_hostmessage_mode"] == 1){{ ' selected' }}@endif>Exibir no log</option>
                                    <option value="2"@if($configs["virtualserver_hostmessage_mode"] == 2){{ ' selected' }}@endif>Exibir um modal</option>
                                    <option value="3"@if($configs["virtualserver_hostmessage_mode"] == 3){{ ' selected' }}@endif>Exibir um modal e fechar conexão</option>
                                </select>
                                <span class="help-block">Modal é uma caixa de confirmação, e modal fechando conexão não deixa ninguém entrar ao ts.</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-9">

                            </div>
                            <div id="col-sm-3">
                                <button type="submit" class="btn btn-primary">Atulizar Mensagens</button>
                            </div>
                        </div>



                    </form>
                </div>
            </div>
        @endif

    </div><!-- /left -->
    <!-- right -->
    <div class="col-lg-6">
        <!-- plano -->
        <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb"><i class="fa fa-angle-right"></i> Plano</h4>
                <div class="form-horizontal style-form">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Plano atual</label>
                        <div class="col-sm-10">
                            <select class="form-control">
                                <option>{{ $virtualServer->plan()->name }} ({{ $virtualServer->plan()->slots }} slots)</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /plano -->

        @if($configs["virtualserver_status"] == "online")
            <!-- Password -->
            <div class="col-lg-12">
                <div class="form-panel">
                    <h4 class="mb"><i class="fa fa-angle-right"></i> Senha</h4>
                    <form class="form-inline" role="form" method="POST" action="{{ route('account.virtual.password' , ['id' => $virtualServer->id]) }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Senha</label>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="virtualserver_password" placeholder="Senha">
                        </div>
                        <button type="submit" class="btn btn-primary">Trocar senha</button>
                    </form>
                </div>
            </div>
            <!-- /password -->
        @endif

        @if($configs["virtualserver_status"] == "online")
            <div class="col-lg-12">
                <div class="form-panel">
                    <h4 class="mb"><i class="fa fa-angle-right"></i> Banner</h4>
                    <form class="form-horizontal style-form" method="POST" action="{{ route('account.virtual.banner' , ['id' => $virtualServer->id]) }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Url</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="virtualserver_hostbanner_url" value="{{ $configs["virtualserver_hostbanner_url"] }}">
                                <span class="help-block">Url a qual o banner vai levar.</span>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-2 control-label">Url do banner</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="virtualserver_hostbanner_gfx_url" value="{{ $configs["virtualserver_hostbanner_gfx_url"] }}">
                                <span class="help-block">Url da imagem do banner.</span>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tempo do banner</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="virtualserver_hostbanner_gfx_interval" value="{{ $configs["virtualserver_hostbanner_gfx_interval"] }}">
                                <span class="help-block">Tempo da animação.</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tempo do banner</label>
                            <div class="col-sm-10">
                                <select name="virtualserver_hostbanner_mode" class="form-control">
                                    <option value="0"@if($configs["virtualserver_hostbanner_mode"] == 0){{ ' selected' }}@endif>Não re-ajustar</option>
                                    <option value="1"@if($configs["virtualserver_hostbanner_mode"] == 1){{ ' selected' }}@endif>Re-ajustar e manter ratio</option>
                                    <option value="2"@if($configs["virtualserver_hostbanner_mode"] == 2){{ ' selected' }}@endif>Re-ajustar e ignorar ratio</option>
                                </select>
                                <span class="help-block">Modo de re-ajuste da imagem.</span>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-sm-9">

                            </div>
                            <div id="col-sm-3">
                                <button type="submit" class="btn btn-primary">Atulizar Banner</button>
                            </div>
                        </div>



                    </form>
                </div>
            </div>
        @endif

    </div>
    <!-- /right -->
</div>
@endsection

@section('js-scripts')
<script>
    $("#power").change(function() {
        if (this.checked) {
            setTimeout(function() {
                $(location).attr('href', '{{ route('account.virtual.powerOn',['id' => $virtualServer->id]) }}')
            }, 200);

        } else {
            setTimeout(function() {
                $(location).attr('href', '{{ route('account.virtual.powerOff',['id' => $virtualServer->id]) }}')
            }, 200);
        }
    });
</script>
@endsection