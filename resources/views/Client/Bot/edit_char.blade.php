@extends('Client.Layout.default')
@section('title','Editar um Character')
@section('content')
    @include('Client.Bot.partials.menu')
    <div class="col-lg-6">
        <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb"><i class="fa fa-angle-right"></i> {{ $character->name }}</h4>
                <form class="form-horizontal style-form" method="POST" action="{{ route('account.virtual.bot.char.update',['char_id' => $character->id , 'id' => $bot->vserver->id]) }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nome atual</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ $character->name }}" disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-10">
                            @if($character->wasDeleted)<span class="badge bg-important">deletado</span>@else<span class="badge bg-success">existente</span>@endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Posição</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="position">
                                <option value="0"@if($character->position == 0) selected @endif>Enemy</option>
                                <option value="1"@if($character->position == 1) selected @endif>Friend</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Avisar quando morrer</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="alert_death">
                                <option value="0"@if(true) selected @endif>Sim</option>
                                <option value="1"@if(false) selected @endif>Não</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-9">

                        </div>
                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-primary pull-right">Atualizar</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
@endsection