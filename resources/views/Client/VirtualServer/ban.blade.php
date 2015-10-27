@extends("Client.Layout.default")
@section('title','Ban List')
@section('content')

    <div class="row mt">
        <div class="col-md-12">
            <div class="content-panel">
                <table class="table table-striped table-advance table-hover">
                    <h4><i class="fa fa-angle-right"></i> Ban list</h4>
                    <hr>
                    <thead>
                    <tr>
                        <th>UID / IP </th>
                        <th>Razão</th>
                        <th>Criado por</th>
                        <th>Termina</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($bans as $ban)
                    <tr>
                        <td>{{ $ban['ip'].$ban['uid'] }}</td>
                        <td>{{ $ban['reason'] }}</td>
                        <td>{{ $ban['invokername'] }}</td>
                        <td>@if($ban['duration']){{\Carbon\Carbon::now()->timestamp($ban['created']+$ban['duration'])->diffForHumans() }}@else permanente @endif</td>
                        <td>
                            <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection