@extends('Client.Layout.default')
@section('title','Ooops')
@section('content')
    <h1>Para prosseguir você deve confirmar sua conta...</h1>
    Nós lhe enviamos um e-mail para: {{ $auth->user()->email }} , verifique sua caixa de e-mails não desejados.
    <h3>Caso não tenha recebido:</h3>
    <a href="#">re-enviar o email</a>
@endsection