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
                            <input type="text" class="form-control" value="{{ $configs['server']['status']['ip'] }}">
                            <span class="help-block">Não modifique, apenas serve para exibir qual ip usar para conectar.</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-10">
                            <b>{{ $configs['server']['status']['state'] }}</b> &nbsp;&nbsp;&nbsp;<input id="power" type="checkbox" @if($configs['server']['status']['state']=="online")checked=""@endif data-toggle="switch" />
                        </div>
                    </div>
                    @if($configs['server']['status']['state'] == "online")
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Slots</label>
                            <div class="col-sm-10">
                                {{ $configs['server']['status']['slots'] }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- /power-->

        @if($configs['server']['status']['state'] == "online")
            <div class="col-lg-12">
                <div class="form-panel">
                    <h4 class="mb"><i class="fa fa-angle-right"></i> Mensagens do servidor</h4>
                    <form class="form-horizontal style-form" method="POST" action="{{ route('account.virtual.messages' , ['id' => $virtualServer->id]) }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Server Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="virtualserver_name" value="{{ $configs['server']['descriptions']['name'] }}">
                                <span class="help-block">Exibido no topo.</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Mensagem de boas vindas</label>
                            <div class="col-sm-10">
                                <textarea name="virtualserver_welcomemessage" class="form-control">{{ $configs['server']['descriptions']['welcome'] }}</textarea>
                                <span class="help-block">Exibido no serverlog quando um usuário entrar.</span>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-2 control-label">Mensagem do Host</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="virtualserver_hostmessage" value="{{ $configs['server']['descriptions']['hostMsg'] }}">
                                <span class="help-block">Exibido quando usuário entrar, escolha abaixo a maneira.</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Exibir a Mensagem do Host da seguinte forma</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="virtualserver_hostmessage_mode">
                                    <option value="0"@if($configs['server']['descriptions']['hostMsgMode'] == 0){{ ' selected' }}@endif>Não exibir</option>
                                    <option value="1"@if($configs['server']['descriptions']['hostMsgMode'] == 1){{ ' selected' }}@endif>Exibir no log</option>
                                    <option value="2"@if($configs['server']['descriptions']['hostMsgMode'] == 2){{ ' selected' }}@endif>Exibir um modal</option>
                                    <option value="3"@if($configs['server']['descriptions']['hostMsgMode'] == 3){{ ' selected' }}@endif>Exibir um modal e fechar conexão</option>
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

        @if($configs['server']['status']['state'] == "online")
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
                            <input type="password" class="form-control" name="password" placeholder="Senha">
                        </div>
                        <button type="submit" class="btn btn-primary">Trocar senha</button>
                    </form>
                </div>
            </div>
            <!-- /password -->
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