@extends('Client.Layout.default')
@section('title','Carrinho')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-10 col-md-offset-1">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Product</th>
                        <th></th>
                        <th class="text-center"></th>
                        <th class="text-center">Preço</th>
                        <th> </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="col-md-6">
                            <div class="media">
                                <a class="thumbnail pull-left" href="#"> <img class="media-object" src="http://orig00.deviantart.net/fc75/f/2012/094/9/4/teamspeak_3_icon__faenza_style__by_aerum-d4uzhu6.png" style="width: 72px; height: 72px;"> </a>
                                <div class="media-body">
                                    <h4 class="media-heading"><a href="#">NP-TS-01</a></h4>
                                    <h5 class="media-heading"> nome <a href="#">TS-Garnera</a></h5>
                                    <span>Status: </span><span class="text-warning"><strong>entrega imediata após pagamento</strong></span>
                                </div>
                            </div></td>
                        <td class="col-md-1" style="text-align: center">

                        </td>
                        <td class="col-md-1 text-center"></td>
                        <td class="col-md-1 text-center"><strong>R$120.00</strong></td>
                        <td class="col-md-1">
                            <button type="button" class="btn btn-danger">
                                <span class="glyphicon glyphicon-remove"></span> Remover
                            </button></td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h5>Subtotal</h5></td>
                        <td class="text-right"><h5><strong>R$120.00</strong></h5></td>
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
                        <td class="text-right"><h3><strong>R$120.00</strong></h3></td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td>
                            <button type="button" class="btn btn-default">
                                <span class="glyphicon glyphicon-shopping-cart"></span> Continuar Comprando
                            </button></td>
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