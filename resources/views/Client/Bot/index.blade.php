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
@endsection