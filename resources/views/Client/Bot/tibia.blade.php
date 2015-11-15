@extends('Client.Layout.default')
@section('title','Tibia List Channels')
@section('content')
    <form method="POST" action="{{ route('account.virtual.bot.tibiaSettingsUpdate' , ['id' => $bot->vserver->id]) }}">
        {{ csrf_field() }}
        <div class="form-group">
            Channel Friend List:
            <select class="form-control" name="friend_ch_id">
                @forelse($channels as $channel)
                    <option value="{{ $channel['cid'] }}" @if($bot->tibiaList->friend_ch_id == $channel['cid']) selected @endif >{{ $channel['channel_name'] }}</option>
                @empty
                    <option value="0">Nenhum Channel, server desligado.</option>
                @endforelse
            </select>
        </div>
        <div class="form-group">
            Channel Enemy List:
            <select class="form-control" name="enemy_ch_id">
                @forelse($channels as $channel)
                    <option value="{{ $channel['cid'] }}" @if($bot->tibiaList->enemy_ch_id == $channel['cid']) selected @endif >{{ $channel['channel_name'] }}</option>
                @empty
                    <option value="0">Nenhum Channel, server desligado.</option>
                @endforelse
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success">Editar configurações de channel da tibia list</button>
        </div>
    </form>
@endsection