@extends('Client.Layout.default')
@section('title' , 'Minha conta')
@section('content')
    Bem vindo {{ $auth->user()->name }}
@endsection