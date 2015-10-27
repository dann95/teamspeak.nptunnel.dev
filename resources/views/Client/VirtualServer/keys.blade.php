@extends('Client.Layout.default')
@section('title','Privillege Keys')
@section('content')
    <div class="col-lg-6">
        <div class="form-panel">
            <h4 class="mb"><i class="fa fa-angle-right"></i> Criar Privilege Key</h4>
            <form class="form-horizontal style-form" method="POST" action="{{ route('account.virtual.keys.create' , ['id' => $id]) }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="col-sm-2 control-label">Grupo</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="sgid">
                            @foreach($groups as $group)
                                <option value="{{ $group['sgid'] }}">{{ $group }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-9 control-label"></label>
                    <div class="col-sm-3">
                        <button class="btn btn-primary">Criar Privilege key</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="col-lg-12">
            <div class="content-panel">
                <h4><i class="fa fa-angle-right"></i> Privilege Keys</h4>
                <section id="unseen">
                    <table class="table table-bordered table-striped table-condensed">
                        <thead>
                        <tr>
                            <th>Server Group</th>
                            <th>Key</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($keys as $key => $k)
                        <tr>
                            <td>{{ $groupsById[$k['token_id1']] }}</td>
                            <td>{{ $key }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </section>
            </div>
        </div>
    </div>
@endsection