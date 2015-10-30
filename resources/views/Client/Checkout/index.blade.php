@extends('Client.Layout.default')
@section('title','Finalizar Compra')
@section('content')
    <form method="POST" action="{{ route('account.cart.checkout') }}">
        {{ csrf_field() }}
        <button type="submit" class="btn btn-primary">pagar</button>
    </form>
@endsection