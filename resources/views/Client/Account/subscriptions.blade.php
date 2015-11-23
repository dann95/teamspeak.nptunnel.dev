@extends('Client.Layout.default')
@section('title','Minhas subscrições')
@section('content')
    <div class="col-md-12 mt">
        <div class="content-panel">
            <table class="table table-hover">
                <h4><i class="fa fa-angle-right"></i> Lista de subscrições</h4>
                <hr>
                <thead>
                <tr>
                    <th>Numero da subscrição</th>
                    <th>Serviço</th>
                    <th>status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($auth->user()->subscriptions() as $subscription)
                    <tr>
                        <td>{{ $subscription->id }}</td>
                        <td>{{ $subscription->virtualServer()->name }}</td>
                        <td>@if($subscription->active)<span class="badge bg-success">ativa</span>@else<span class="badge bg-important">desativada</span>@endif</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div><! --/content-panel -->
    </div><!-- /col-md-12 -->
@endsection