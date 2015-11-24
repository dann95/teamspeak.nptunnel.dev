@extends('Client.Layout.default')
@section('title','Guilds marcadas como Enemy')
@section('content')
    @include('Client.Bot.partials.menu')
    <div class="row mt">
        <div class="col-md-12">
            <div class="content-panel">
                <table class="table table-striped table-advance table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Adicionada</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($bot->tibiaList->enemyGuilds() as $guild)
                        <tr>
                            <td>{{ $guild->id }}</td>
                            <td>{{ $guild->name }}</td>
                            <td>{{ $guild->created_at->format("d/m/Y") }}</td>
                            <td>
                                <div class="pull-right">
                                    <a href="{{ route('account.virtual.bot.friend.guild.del',['id' => $bot->vserver->id ,'guild_id' => $guild->id]) }}"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>
                                    <a href="{{ route('account.virtual.bot.friend.guild.del',['id' => $bot->vserver->id ,'guild_id' => $guild->id]) }}"><button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div><!-- /content-panel -->
        </div><!-- /col-md-12 -->
    </div><!-- /row -->
@endsection