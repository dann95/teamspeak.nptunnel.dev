@extends('Client.Layout.default')
@section('title','TsBOT')
@section('content')
@include('Client.Bot.partials.menu')
    <form method="POST" action="{{ route('account.virtual.bot.settings' , ['id' => $bot->vserver->id]) }}">
        <div class="form-group">
            {{ csrf_field() }}
            Tibia List?
            <select class="form-control" name="tibia_list">
                <option value="0"@if($bot->tibia_list == 0) selected @endif>Desabilitada</option>
                <option value="1"@if($bot->tibia_list == 1) selected @endif>Habilitada</option>
            </select>
        </div>
        <div class="form-group">
            Auto afk?
            <select class="form-control" name="auto_afk">
                <option value="0"@if($bot->auto_afk == 0) selected @endif>Desabilitado</option>
                <option value="1"@if($bot->auto_afk == 1) selected @endif>Habilitado</option>
            </select>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success">editar configurações</button>
        </div>
    </form>
@endsection