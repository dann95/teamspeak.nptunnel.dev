@extends('Admin.Layout.default')
@section('title','Servers')
@section('content')
    <div class="row mt">
        <div class="col-md-12">
            <div class="content-panel">
                <table class="table table-striped table-advance table-hover">
                    <h4><i class="fa fa-angle-right"></i> Servers disponiveis</h4>
                    <hr>
                    <thead>
                    <tr>
                        <th><i class="fa fa-diamond"></i> Nome</th>
                        <th class="hidden-phone"><i class="fa fa-child"></i> Slots</th>
                        <th><i class="fa fa-usd"></i> IP</th>
                        <th><i class="fa fa-usd"></i> DNS</th>
                        <th><i class=" fa fa-edit"></i> Status</th>
                        <th><i class=" fa fa-edit"></i> Ativo Vendas</th>

                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($servers as $server)
                        <tr>
                            <td>{{ $server->name }}</td>
                            <td>{{ $server->usage }}</td>
                            <td>{{ $server->ip }}</td>
                            <td>{{ $server->dns }}</td>
                            <td>@if($server->active) <span class="label label-success label-mini">Ativo</span> @else <span class="label label-danger label-mini">Inativo</span> @endif</td>
                            <td>@if($server->active_sales) <span class="label label-success label-mini">Ativo</span> @else <span class="label label-danger label-mini">Inativo</span> @endif</td>
                            <td>
                                <a href="{{ route('server.edit' , ['id' => 1]) }}"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>
                                <a href="{{ route('server.active.sales' , ['id' => 1]) }}"><button class="btn @if($server->active_sales) btn-danger @else btn-success @endif btn-xs"><i class="fa fa-usd "></i></button></a>
                                <a href="{{ route('server.active' , ['id' => 1]) }}"><button class="btn @if($server->active) btn-danger @else btn-success @endif btn-xs"><i class="fa fa-power-off "></i></button></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><!-- /content-panel -->
        </div><!-- /col-md-12 -->
    </div><!-- /row -->
@endsection