@extends('front.layout.default')
@section('title' , 'Nossos planos:')
@section('content')
    <div class="col-lg-8">
    <div class="row">
        @foreach($planos as $plano)
        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
            <!-- PRICE ITEM -->
            <div class="panel price panel-blue">
                <div class="panel-heading arrow_box text-center">
                    <h3>{{ $plano['name'] }}</h3>
                </div>
                <div class="panel-body text-center">
                    <p class="lead" style="font-size:20px"><strong>R${{ $plano['price'] }} / por mês</strong></p>
                </div>
                <ul class="list-group list-group-flush text-center">
                    <li class="list-group-item"><i class="fa fa-user"></i> {{ $plano['slots'] }} slots</li>
                    <li class="list-group-item"><i class="fa fa-check"></i>Proteção DDoS</li>
                    <li class="list-group-item"><i class="fa fa-check"></i> Painel Administrativo</li>
                    <li class="list-group-item"><i class="fa fa-check"></i> Suporte</li>
                </ul>
                <div class="panel-footer">
                    <a class="btn btn-lg btn-block btn-success" href="{{ route('plan.select' , ['id' => $plano['id']]) }}">escolher plano</a>
                </div>
            </div>
            <!-- /PRICE ITEM -->
        </div>
        @endforeach
    </div>
    </div>
@endsection