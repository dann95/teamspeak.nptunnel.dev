@extends('Client.Layout.default')
@section('title','Pedido #'.$invoice->id)
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-10 col-md-offset-1">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Serviço</th>
                        <th></th>
                        <th class="text-center"></th>
                        <th class="text-center">Preço</th>
                        <th> </th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($invoice->items as $item)
                            <tr>
                                <td class="col-md-6">
                                    <div class="media">
                                        <a class="thumbnail pull-left" href="#"> <img class="media-object" src="http://orig00.deviantart.net/fc75/f/2012/094/9/4/teamspeak_3_icon__faenza_style__by_aerum-d4uzhu6.png" style="width: 72px; height: 72px;"> </a>
                                        <div class="media-body">
                                            <h4 class="media-heading"><a href="#">{{ $item->plan()->name }}</a></h4>
                                            <h5 class="media-heading"> nome <b>{{ $item->vserver_name }}</b></h5>
                                            <span>Status: </span><span class="text-warning"><strong>{{ $invoice->status }}</strong></span>
                                        </div>
                                    </div></td>
                                <td class="col-md-1" style="text-align: center">

                                </td>
                                <td class="col-md-1 text-center"></td>
                                <td class="col-md-1 text-center"><strong>R$18.99</strong></td>
                                <td class="col-md-1">
                                    botao
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
@endsection