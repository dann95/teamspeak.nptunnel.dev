@extends('Client.Layout.default')
@section('title','Listar Enemies')
@section('content')
    @include('Client.Bot.partials.menu')
    @include('Client.Bot.partials.show_characters',['chars' => $bot->tibiaList->enemies()])

@endsection