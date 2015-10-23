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

        @if($configs['server']['status']['state'] == "online")
            <!-- -->
            <div class="col-lg-12">
                <div class="form-panel">
                    <h4 class="mb"><i class="fa fa-angle-right"></i> Senha</h4>
                    <div class="form-horizontal style-form">

                    </div>
                </div>
            </div>
        @endif
        <!-- /power-->
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