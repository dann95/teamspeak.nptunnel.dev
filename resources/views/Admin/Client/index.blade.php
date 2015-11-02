@extends('Admin.Layout.default')
@section('title','Lista de clientes')
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
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Subscrições</th>
                        <th>Perguntas Helpdesk</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($customers as $customer)
                    <tr>
                        <td>{{ $customer->id }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ count($customer->subscriptions()) }}</td>
                        <td>não disponivel</td>
                        <td>
                            <a href="#"><button class="btn  btn-primary  btn-xs"><i class="fa fa-search "></i></button></a>
                            <a href="#"><button class="btn  btn-primary  btn-xs"><i class="fa fa-envelope "></i></button></a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div><!-- /content-panel -->
        </div><!-- /col-md-12 -->
    </div><!-- /row -->
@endsection