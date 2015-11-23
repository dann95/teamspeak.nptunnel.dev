@extends('Client.Layout.default')
@section('title','Inserir um friend')
@section('content')
    @include('Client.Bot.partials.menu')
    <form method="POST" action="{{ route('account.virtual.bot.friend.guild.store' , ['id' => $bot->vserver->id]) }}">
        {{ csrf_field() }}
        <div class="form-group">
            <input type="text" name="name" placeholder="Nome da guild" class="form-control">
            <button class="btn btn-success" type="submit">Adicionar</button>
        </div>
    </form>
@endsection