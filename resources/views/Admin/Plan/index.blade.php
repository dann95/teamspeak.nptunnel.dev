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
                        <th><i class="fa fa-diamond"></i> Name</th>
                        <th class="hidden-phone"><i class="fa fa-child"></i> Slots</th>
                        <th><i class="fa fa-usd"></i> Price</th>
                        <th><i class=" fa fa-edit"></i> Status</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($plans as $plan)
                    <tr>
                        <td></td>
                        <td>{{ $plan->slots }}</td>
                        <td>R${{ $plan->price }} </td>
                        <td><span class="label label-info label-mini">Due</span></td>
                        <td>
                            <a href="{{ route('plan.delete' , ['id' => $plan->id]) }}"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>
                            <a href="{{ route('plan.delete' , ['id' => $plan->id]) }}"><button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button></a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div><!-- /content-panel -->
        </div><!-- /col-md-12 -->
    </div><!-- /row -->
@endsection