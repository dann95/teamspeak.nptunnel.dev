@extends('Front.Layout.default')
@section('title','Comprar um servidor')
@section('content')
    <div class="row mt">
        <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb"><i class="fa fa-angle-right"></i> Escolher</h4>
                <form class="form-inline" role="form" method="POST" action="{{ route('account.cart.add') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <select class="form-control" name="plan_id">
                            @foreach($planos as $plano)
                            <option value="{{ $plano->id }}"@if($plano->id == $id) selected @endif>{{ $plano->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" placeholder="Nome para o servidor" value="{{ old('name') }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Selecionar</button>
                </form>
            </div>
        </div>
    </div>
@endsection