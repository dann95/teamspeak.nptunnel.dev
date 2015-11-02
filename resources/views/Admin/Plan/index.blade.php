@extends('Admin.Layout.default')
@section('title','Plans')
@section('content')
    <div class="row mt">
        <div class="col-md-12">
            <div class="content-panel">
                <table class="table table-striped table-advance table-hover">
                    <h4><i class="fa fa-angle-right"></i> Planos disponiveis</h4>
                    <hr>
                    <thead>
                    <tr>
                        <th><i class="fa fa-diamond"></i> Nome</th>
                        <th class="hidden-phone"><i class="fa fa-child"></i> Slots</th>
                        <th><i class="fa fa-usd"></i> Preço</th>
                        <th><i class=" fa fa-edit"></i> Status</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($plans as $plan)
                    <tr>
                        <td>{{ $plan->name }}</td>
                        <td>{{ $plan->slots }}</td>
                        <td>R${{ $plan->price }} </td>
                        <td>@if($plan->active) <span class="label label-success label-mini">Ativo</span> @else <span class="label label-danger label-mini">Inativo</span> @endif </td>
                        <td>
                            <a href="{{ route('plan.index' , ['id' => $plan->id]) }}"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>
                            <a href="{{ route('plan.power' , ['id' => $plan->id]) }}"><button class="btn @if($plan->active) btn-danger @else btn-success @endif btn-xs"><i class="fa fa-power-off "></i></button></a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div><!-- /content-panel -->
        </div><!-- /col-md-12 -->
    </div><!-- /row -->
@endsection