@extends('Client.Layout.default')
@section('title','Meus pedidos')
@section('content')
    <div class="col-md-12 mt">
        <div class="content-panel">
            <table class="table table-hover">
                <h4><i class="fa fa-angle-right"></i> Lista de pedidos</h4>
                <hr>
                <thead>
                <tr>
                    <th>Numero do pedido</th>
                    <th>Valor</th>
                    <th>efetuado dia</th>
                    <th>status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($auth->user()->invoices() as $invoice)
                <tr>
                    <td><a href="{{ route('account.invoice.show' , ['id' => $invoice->id]) }}">pedido #{{ $invoice->id }}</a></td>
                    <td>{{ $invoice->total }}</td>
                    <td>{{ $invoice->created_at }}</td>
                    <td>{{ $invoice->status }}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div><! --/content-panel -->
    </div><!-- /col-md-12 -->
@endsection