@extends('Client.Layout.default')
@section('title','Carrinho')
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
                    @foreach(Session::get('cart')->all() as $id => $compra)
                    <tr>
                        <td class="col-md-6">
                            <div class="media">
                                <a class="thumbnail pull-left" href="#"> <img class="media-object" src="http://orig00.deviantart.net/fc75/f/2012/094/9/4/teamspeak_3_icon__faenza_style__by_aerum-d4uzhu6.png" style="width: 72px; height: 72px;"> </a>
                                <div class="media-body">
                                    <h4 class="media-heading"><a href="#">{{ $compra['plan']->name }} ({{ $compra['plan']->slots }} slots)</a></h4>
                                    <h5 class="media-heading"> nome <b>{{ $compra['name'] }}</b></h5>
                                    <span>Status: </span><span class="text-warning"><strong>entrega imediata após pagamento</strong></span>
                                </div>
                            </div></td>
                        <td class="col-md-1" style="text-align: center">

                        </td>
                        <td class="col-md-1 text-center"></td>
                        <td class="col-md-1 text-center"><strong>R${{ $compra['plan']->price }}</strong></td>
                        <td class="col-md-1">
                            <a class="btn btn-danger" href="{{ route('account.cart.del' , ['id' => $id]) }}">
                                <span class="glyphicon glyphicon-remove"></span> Remover
                            </a></td>
                    </tr>
                    @endforeach
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h5>Subtotal</h5></td>
                        <td class="text-right"><h5><strong>R${{ number_format(Session::get('cart')->total(),2) }}</strong></h5></td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h5>Desconto</h5></td>
                        <td class="text-right"><h5><strong>R$0.00</strong></h5></td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h3>Total</h3></td>
                        <td class="text-right"><h3><strong>R${{ number_format(Session::get('cart')->total(),2) }}</strong></h3></td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td>
                            <a class="btn btn-default" href="{{ route('planos') }}">
                                <span class="glyphicon glyphicon-shopping-cart"></span> Continuar Comprando
                            </a></td>
                        <td>
                            <button type="button" class="btn btn-success">
                                Checkout <span class="glyphicon glyphicon-play"></span>
                            </button></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection