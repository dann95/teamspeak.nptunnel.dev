@extends('Admin.Layout.default')
@section('title','Lista de virtual servers')
@section('content')
    <div class="row mt">
        <div class="col-md-12">
            <div class="content-panel">
                <table class="table table-striped table-advance table-hover">
                    <h4><i class="fa fa-angle-right"></i> Lista de clientes</h4>
                    <hr>
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome Serviço</th>
                        <th>Cliente</th>
                        <th>Plano</th>
                        <th>Servidor</th>
                        <th>Criado</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($vservers as $vserver)
                            <tr>
                                <td>{{ $vserver->id }}</td>
                                <td>{{ $vserver->name }}</td>
                                <td>{{ $vserver->user()->name }}</td>
                                <td>{{ $vserver->plan()->name }}</td>
                                <td>{{ $vserver->server()->name }}</td>
                                <td>{{ $vserver->created_at }}</td>
                                <td>
                                    <a href="#"><button class="btn  btn-primary  btn-xs"><i class="fa fa-search "></i></button></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><!-- /content-panel -->
        </div><!-- /col-md-12 -->
    </div><!-- /row -->
@endsection