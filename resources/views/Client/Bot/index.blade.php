@extends('Client.Layout.default')
@section('title','TsBOT')
@section('content')
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand">r2d2BOT</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="{{ route('account.virtual.bot.index' , ['id' => $bot->vserver->id]) }}">Ajustes</a></li>
                    @if($bot->tibia_list)
                    <li><a href="{{ route('account.virtual.bot.tibiaSettings' , ['id' => $bot->vserver->id]) }}">Ajustes Channels Tibia List</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Friend list <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-header">Players</li>
                            <li><a href="{{ route('account.virtual.bot.friend.index' , ['id' => $bot->vserver->id]) }}">Listar players</a></li>
                            <li><a href="{{ route('account.virtual.bot.friend.add' , ['id' => $bot->vserver->id]) }}">Adicionar player</a></li>
                            <li><a href="{{ route('account.virtual.bot.friend.del' , ['id' => $bot->vserver->id]) }}">Remover Player</a></li>
                            <li role="separator" class="divider"></li>
                            <li class="dropdown-header">Guilds</li>
                            <li><a href="{{ route('account.virtual.bot.friend.guild.index' , ['id' => $bot->vserver->id]) }}">Listar guilds</a></li>
                            <li><a href="{{ route('account.virtual.bot.friend.guild.add' , ['id' => $bot->vserver->id]) }}">Adicionar guild</a></li>
                            <li><a href="{{ route('account.virtual.bot.friend.guild.del' , ['id' => $bot->vserver->id]) }}">Remover guild</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Enemy list <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-header">Players</li>
                            <li><a href="{{ route('account.virtual.bot.enemy.index' , ['id' => $bot->vserver->id]) }}">Listar players</a></li>
                            <li><a href="{{ route('account.virtual.bot.enemy.add' , ['id' => $bot->vserver->id]) }}">Adicionar player</a></li>
                            <li><a href="{{ route('account.virtual.bot.enemy.del' , ['id' => $bot->vserver->id]) }}">Remover Player</a></li>
                            <li role="separator" class="divider"></li>
                            <li class="dropdown-header">Guilds</li>
                            <li><a href="{{ route('account.virtual.bot.enemy.guild.index' , ['id' => $bot->vserver->id]) }}">Listar guilds</a></li>
                            <li><a href="{{ route('account.virtual.bot.enemy.guild.add' , ['id' => $bot->vserver->id]) }}">Adicionar guild</a></li>
                            <li><a href="{{ route('account.virtual.bot.enemy.guild.del' , ['id' => $bot->vserver->id]) }}">Remover guild</a></li>
                        </ul>
                    </li>

                    @endif

                </ul>
            </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
    </nav>
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