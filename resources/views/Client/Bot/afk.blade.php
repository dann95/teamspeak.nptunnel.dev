@extends('Client.Layout.default')
@section('title','TsBOT')
@section('content')
    @include('Client.Bot.partials.menu')
    <form method="POST" action="{{ route('account.virtual.bot.settings' , ['id' => $bot->vserver->id]) }}">
        <div class="form-group">
            {{ csrf_field() }}

        <div class="form-group">
            Mover para o channel:
            <select class="form-control" name="afk_ch_id">
                @forelse($channels as $channel)
                    <option value="{{ $channel['cid'] }}" @if($bot->afk_ch_id == $channel['cid']) selected @endif >{{ $channel['channel_name'] }}</option>
                @empty
                    <option value="0">Nenhum Channel, server desligado.</option>
                @endforelse
            </select>
        </div>
        <div class="form-group">
            Tempo máximo afk:
            <input type="text" class="form-control" value="{{ $bot->max_afk_time }}" name="max_afk_time">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success">editar configurações</button>
        </div>
    </form>
@endsection